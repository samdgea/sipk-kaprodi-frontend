<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const ACCOUNT_ACTIVE = 10;
    const ACCOUNT_BLOCKED = 99;
    const ACCOUNT_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_status'], 'default', 'value' => null],
            [['account_status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'email_address'], 'string', 'max' => 50],
            [['user_name'], 'string', 'max' => 25],
            [['password_hashed'], 'string', 'max' => 255],
            [['email_address'], 'unique'],
            [['user_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'user_name' => 'User Name',
            'email_address' => 'Email Address',
            'password_hashed' => 'Password Hashed',
            'account_status' => 'Account Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $access = AccessToken::find()->where([
            'access_token' => $token, 
            'token_valid' => true
        ])->one();

        return (!empty($access) && strtotime($access->expires_at) >= time()) ? $access->getUser()->one() : null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['user_name' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->primaryKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        throw new NotSupportedException("This method is not implemented yet");
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException("This method is not implemented yet");
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hashed);
    }

    /**
     * Generates password hash
     * Creates encrypted from plain text to SHA1 Hash
     * 
     * @param string $plain_text Plain password to be encrypted
     * @return void nothing to returned
     */
    public function makePassword($plain_text) 
    {
        $this->password_hashed = Yii::$app->getSecurity()->generatePasswordHash($plain_text);
    }

    public function makeEmailVerifyHash()
    {
        $this->email_verification_hash = Yii::$app->getSecurity()->generateRandomString(50);
    }

    /**
     * Generates Access Token
     * 
     * @return string Access Token
     */
    public function generateAccessToken()
    {
        $accessToken = new AccessToken();
        $accessToken->user_id = $this->getPrimaryKey();
        $accessToken->access_token = Yii::$app->getSecurity()->generateRandomString();
        $accessToken->expires_at = date('Y-m-d H:i:s', (time()+3600*24*7));
        $accessToken->token_valid = true;
        $accessToken->save();

        return $accessToken->access_token;
    }

    /**
     * List of Access Token
     * 
     * @return AccessToken[] list of AccessToken
     */
    public function getAccessToken()
    {
        return $this->hasMany(AccessToken::class, ['user_id' => 'id']);
    }
}
