<?php

namespace common\models\repositories;

class PartnerBranchRepository extends \common\models\db\PartnerBranch
{
    public $_partner = null;
    public $_category = null;

    /**
     * @return PartnerBranchRepository[]|[]
     */
    public static function getAll()
    {
        return self::find()->all();
    }

    /**
     * @param int $partner_id
     * @return PartnerBranchRepository[]|[]
     */
    public static function getByPartnerId(int $partner_id)
    {
        return self::find()->where(['partner_id' => $partner_id])->all();
    }

    /**
     * @return PartnerRepository|null
     */
    public function getPartner()
    {
        if ($this->_partner == null) {
            $this->_partner = $this->hasOne(PartnerRepository::class, ['id' => 'partner_id'])->one();
        }

        return $this->_partner;
    }

    /**
     * @return CategoryRepository|null
     */
    public function getCategory()
    {
        if ($this->_category == null) {
            $this->_category = $this->hasOne(CategoryRepository::class, ['id' => 'category_id'])->one();
        }

        return $this->_category;
    }

    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'partner_id'  => 'Партнер',
            'adddress'    => 'Адрес',
            'coor'        => 'Координаты',
            'category_id' => 'Категория',
            'cost'        => 'Стоимость',
        ];
    }
}
