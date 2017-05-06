<?php
namespace app\commands;

use app\rbac\UserGroupRule;
use yii\console\Controller;

/**
 * RBAC generator
 */
class RbacController extends Controller
{
    /**
     * Generates roles
     */
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        // Create roles
        $admin  = $auth->createRole('admin');
        $user  = $auth->createRole('user');
        $guest = $auth->createRole('guest');

        // Create simple, based on action{$NAME} permissions
        $login  = $auth->createPermission('login');
        $logout = $auth->createPermission('logout');
        $error  = $auth->createPermission('error');
        $signUp = $auth->createPermission('sign-up');
        $index  = $auth->createPermission('index');
        $view   = $auth->createPermission('view');
        $create = $auth->createPermission('create');
        $update = $auth->createPermission('update');
        $delete = $auth->createPermission('delete');
        $manageUsers = $auth->createPermission('manageUsers');

        // Add permissions in Yii::$app->authManager
        $auth->add($login);
        $auth->add($logout);
        $auth->add($error);
        $auth->add($signUp);
        $auth->add($index);
        $auth->add($view);
        $auth->add($create);
        $auth->add($update);
        $auth->add($delete);
        $auth->add($manageUsers);

        // Add rule, based on User->role === $user->group
        $userGroupRule = new UserGroupRule();
        $auth->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
        $guest->ruleName  = $userGroupRule->name;
        $user->ruleName  = $userGroupRule->name;
        $admin->ruleName  = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $auth->add($user);
        $auth->add($admin);
        $auth->add($guest);

        // Add permission-per-role in Yii::$app->authManager
        // Guest
        $auth->addChild($guest, $login);
        $auth->addChild($guest, $logout);
        $auth->addChild($guest, $error);
        $auth->addChild($guest, $signUp);

        // User
        $auth->addChild($user, $guest);
        $auth->addChild($user, $index);
        $auth->addChild($user, $view);

        // Admin
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $create);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $delete);
        $auth->addChild($admin, $manageUsers);
    }
    
}