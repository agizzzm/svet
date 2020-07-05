<?php

namespace common\models\repositories;

class PartnerBranchRepository extends \common\models\db\PartnerBranch
{
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
}
