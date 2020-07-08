<?php

namespace common\models\repositories;

use common\models\db\PartnerBranch;

class PartnerRepository extends \common\models\db\Partner
{
    public $_branches = null;

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

    /**
     * @return PartnerRepository[]|[]
     */
    public function getBranches()
    {
        if ($this->_branches == null) {
            $this->_branches = $this->hasMany(PartnerBranch::class, ['partner_id' => 'id'])->all();
        }

        return $this->_branches;
    }

    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'name'          => 'Наименование',
            'contact'       => 'Контактное лицо',
            'contact_phone' => 'Телефон контактного лица',
            'email'         => 'Email',
            'region'        => 'Регион',
            'city'          => 'Город',
        ];
    }
}
