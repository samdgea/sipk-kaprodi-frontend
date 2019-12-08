<?php

namespace app\models\Forms\Auth;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $first_name;
    public $last_name;
    public $user_name;
    public $email;
    public $password;
    public $password_repeat;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['first_name', 'user_name', 'email', 'password', 'password_repeat'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['email'], 'email'],
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
            return true;
        }

        return false;
    }
}