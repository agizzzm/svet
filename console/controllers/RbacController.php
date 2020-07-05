<?php

namespace console\controllers;


use common\models\User;
use yii\console\Controller;
use yii\rbac\Role;

class RbacController extends Controller
{
    public function actionInit()
    {
        echo 'Start';
        echo PHP_EOL;

        $authManager = \Yii::$app->authManager;

        $admin = $authManager->getRole('admin');
        if (empty($admin)) {
            $admin = $authManager->createRole('admin');
            $authManager->add($admin);
        }

        $operator = $authManager->getRole('operator');
        if (empty($operator)) {
            $operator = $authManager->createRole('operator');
            $authManager->add($operator);
        }

        $user = User::find()->where(['username' => 'admin'])->one();
        if (empty($user)) {
            $user = new User();
            $user->username = 'admin';
            $user->setPassword('!qwerty!');
            $user->email = 'a-infotex@mail.ru';
            $user->status = User::STATUS_ACTIVE;
            $user->generateAuthKey();
            $user->save();
        }

        $roles = \Yii::$app->authManager->getRolesByUser($user->id);
        if (!array_key_exists('admin', $roles)) {
            $authManager->assign($admin, $user->id);
        }

        echo 'End';
        echo PHP_EOL;
    }
}