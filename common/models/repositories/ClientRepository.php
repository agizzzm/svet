<?php

namespace common\models\repositories;

class ClientRepository extends \yii\db\ActiveRecord
{
    /**
     * @return ClientRepository[]|[]
     */
    public static function getAll()
    {
        return self::find()->all();
    }

    /**
     * @param string $phone
     * @return ClientRepository|null
     */
    public static function getByPhone(string $phone)
    {
        return self::find()->where(['phone' => $phone])->one();
    }

    /**
     * @param string $email
     * @return ClientRepository|null
     */
    public static function getByEmail(string $email)
    {
        return self::find()->where(['email' => $email])->one();
    }
}
