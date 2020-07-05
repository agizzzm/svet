<?php

namespace common\models\repositories;

class PartnerRepository extends \common\models\db\Partner
{
    /**
     * @return PartnerRepository[]|[]
     */
    public static function getAll()
    {
        return self::find()->all();
    }

    /**
     * @param string $phone
     * @return PartnerRepository|null
     */
    public static function getByPhone(string $phone)
    {
        return self::find()->where(['contact_phone' => $phone])->one();
    }

    /**
     * @param string $email
     * @return PartnerRepository|null
     */
    public static function getByEmail(string $email)
    {
        return self::find()->where(['email' => $email])->one();
    }
}
