<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "partners_branches".
 *
 * @property int $id
 * @property int $partner_id Партнер
 * @property string $address Адрес
 * @property int $category_id Категория
 * @property float $cost Стоимость
 * @property string|null $coor Координаты на карте
 * @property string|null $metro Ближайщие метро
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
            [['partner_id', 'address', 'category_id', 'cost'], 'required'],
            [['partner_id', 'category_id'], 'integer'],
            [['address', 'metro'], 'string'],
            [['cost'], 'number'],
            [['coor'], 'string', 'max' => 255],
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
            'category_id' => 'Category ID',
            'cost' => 'Cost',
            'coor' => 'Coor',
            'metro' => 'Metro',
        ];
    }
}
