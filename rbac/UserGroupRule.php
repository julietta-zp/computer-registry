<?php

namespace app\rbac;

use app\models\User;
use Yii;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $group = Yii::$app->user->identity->role;
            if ($item->name == User::ROLE_ADMIN) {
                return $group == User::ROLE_ADMIN;
            } elseif ($item->name == User::ROLE_USER) {
                return $group == User::ROLE_ADMIN || $group == User::ROLE_USER;
            }
        }
        return true;
    }

}