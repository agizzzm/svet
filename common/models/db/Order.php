<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int|null $client_id Клиент
 * @property float|null $cost Оплата
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id'], 'integer'],
            [['cost'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'cost' => 'Cost',
        ];
    }
}
