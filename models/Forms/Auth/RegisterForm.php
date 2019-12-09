<?php

namespace app\models\Forms\Auth;

use Yii;
use yii\base\Model;

use app\models\User;
use GuzzleHttp\Client;

class RegisterForm extends Model
{
    public $first_name;
    public $last_name;
    public $user_name;
    public $email;
    public $password;
    public $password_repeat;

    private $_user;
    private $_http;

    public function __construct()
    {
        $this->_user = new User;
        $this->_http = new Client([
            'base_uri' => Yii::$app->params['sipk_api_path']
        ]);
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['first_name', 'user_name', 'email', 'password', 'password_repeat'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email_address'],
            [['user_name'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'user_name'],
            [['user_name'], 'string', 'max' => 15],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if ($this->password !== $this->password_repeat) 
            $this->addError($attribute, 'Password did not match');
    }

    public function doRegister()
    {
        if ($this->validate())
        {
            try {
                $request = $this->_http->request('POST', 'auth/register', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json'
                    ],
                    'json' => [
                        'first_name' => $this->first_name,
                        'last_name' => $this->last_name,
                        'user_name' => $this->user_name,
                        'email_address' => $this->email,
                        'password' => $this->password
                    ]
                ]);

                if (!empty($request->getBody())):
                    $response = json_decode($request->getBody());

                    if ($response->success == true) {
                        return true;
                    } else {
                        $this->addError('email', json_encode($response->data));
                    }
                else:
                    $this->addError('email', 'Unknown server error occurred');
                endif;
            } catch(\GuzzleHttp\Exception\RequestException $e) {
                $this->addError('email', 'Unable to access server');
            }
        }

        return false;
    }
}