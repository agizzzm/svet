<?php

namespace common\models\repositories;

use yii\helpers\ArrayHelper;

class UserRepository extends \common\models\User
{
    public $password_new;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['email'], 'unique'],
        ]);
    }

    /**
     * @return UserRepository[]|[]
     */
    public static function getAll()
    {
        return self::find()->all();
    }

    /**
     * @param string $login
     * @return UserRepository|null
     */
    public static function getByLogin(string $login)
    {
        return self::find()->where(['email' => $login])->one();
    }

    /**
     * @param int $id
     * @return UserRepository|null
     */
    public static function getById(int $id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'email'         => 'Логин',
            'password_hash' => 'Пароль',
            'password_new'  => 'Новый пароль',
            'partners_ids'  => 'Назначенные партнеры',
            'role'          => 'Роль',
        ];
    }
}
