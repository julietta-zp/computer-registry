<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $password;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['first_name', 'filter', 'filter' => 'trim'],
            ['first_name', 'required'],

            ['last_name', 'filter', 'filter' => 'trim'],
            ['last_name', 'required'],

            ['password', 'required']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->role = User::ROLE_USER;
            $user->setPassword($this->password);
            $user->save();

            // assign ROLE_USER after sign up by default
            $auth = \Yii::$app->authManager;
            $userRole = $auth->getRole(User::ROLE_USER);
            $auth->assign($userRole, $user->getId());

            return $user;
        }
        return null;
    }
}