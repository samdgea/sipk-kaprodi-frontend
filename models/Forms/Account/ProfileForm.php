<?php

namespace app\models\Forms\Account;

use app\models\User;
use Yii;
use yii\base\Model;

class ProfileForm extends Model 
{
    const SCENARIO_BASIC_INFORMATION = 'EDIT_PROFILE';
    const SCENARIO_CHANGE_PASSWORD = 'EDIT_PASSWORD';

    public $first_name;
    public $last_name;
    public $user_name;
    public $email_address;
    public $old_password;
    public $new_password;
    public $new_password_repeat;

    private $_user;

    private $formName = "ProfileForm";

    public function __construct()
    {
        $this->_user = Yii::$app->user->identity;
        $this->first_name = $this->_user->first_name;
        $this->last_name = $this->_user->last_name;
        $this->email_address = $this->_user->email_address;
        $this->user_name = $this->_user->user_name;
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_BASIC_INFORMATION => ['first_name', 'last_name', 'user_name', 'email_address'],
            self::SCENARIO_CHANGE_PASSWORD => ['old_password', 'new_password', 'new_password_repeat']
        ];
    }

    public function rules()
    {
        return [
            [['first_name', 'user_name', 'email_address'], 'required', 'on' => self::SCENARIO_BASIC_INFORMATION],
            [['user_name'], 'string', 'max' => 15, 'on' => self::SCENARIO_BASIC_INFORMATION],
            [['first_name', 'last_name'], 'string', 'max' => 50, 'on' => self::SCENARIO_BASIC_INFORMATION],
            [['email_address'], 'email', 'on' => self::SCENARIO_BASIC_INFORMATION],
            [['user_name'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'user_name', 'when' => function($model) {
                return $model->user_name != $this->_user->user_name;
            }, 'on' => self::SCENARIO_BASIC_INFORMATION],
            [['email_address'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'user_name', 'on' => self::SCENARIO_BASIC_INFORMATION],

            [['old_password', 'new_password', 'new_password_repeat'], 'required', 'on' => self::SCENARIO_CHANGE_PASSWORD],
            ['old_password', 'validateOldPassword', 'on' => self::SCENARIO_CHANGE_PASSWORD],
            ['new_password', 'validateNewPassword', 'on' => self::SCENARIO_CHANGE_PASSWORD]
        ];
    }

    public function validateOldPassword($attribute, $params)
    {
        if (!Yii::$app->getSecurity()->validatePassword($this->old_password, $this->_user->password_hashed)) 
            $this->addError($attribute, "Invalid old password");
    }

    public function validateNewPassword($attribute, $params) 
    {
        if ($this->new_password !== $this->new_password_repeat)
            $this->addError($attribute, "New password did not match");

        if ($this->old_password === $this->new_password) 
            $this->addError($attribute, "New password can not be same as old password");
    }

    public function doChangeProfileInfo()
    {
        if ($this->validate()) {
            $user = User::findOne($this->_user->id);
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->user_name = $this->user_name;

            return $user->save();
        }

        return false;
    }
    
    public function doChangePassword()
    {
        if ($this->validate()) {
            $user = User::findOne($this->_user->id);
            $user->makePassword($this->new_password);

            return $user->save();
        }

        return false;
    }

    public function setFormName($formName) 
    {
        $this->formName = $formName;
    }

    public function formName()
    {
        return $this->formName;
    }
}