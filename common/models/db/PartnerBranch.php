<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "partners_branches".
 *
 * @property int $id
 * @property int $partner_id Партнер
 * @property string $address Адрес
 * @property string $category Категория
 * @property float $cost Стоимость
 */
class PartnerBranch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partners_branches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id', 'address', 'category', 'cost'], 'required'],
            [['partner_id'], 'integer'],
            [['address'], 'string'],
            [['cost'], 'number'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_id' => 'Partner ID',
            'address' => 'Address',
            'category' => 'Category',
            'cost' => 'Cost',
        ];
    }
}
