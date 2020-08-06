<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string|null $lastname Фамилия
 * @property string|null $firstname Имя
 * @property string|null $middlename Отчество
 * @property string $phone Телефон
 * @property string $email Email
 * @property int $category_id Категория
 * @property float|null $cost Стоимость
 * @property float|null $first_payment Первый взнос
 * @property int|null $partner_id Партнер
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'email', 'category_id'], 'required'],
            [['category_id', 'partner_id'], 'integer'],
            [['cost', 'first_payment'], 'number'],
            [['lastname', 'firstname', 'middlename', 'phone', 'email'], 'string', 'max' => 255],
            [['phone'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'phone' => 'Phone',
            'email' => 'Email',
            'category_id' => 'Category ID',
            'cost' => 'Cost',
            'first_payment' => 'First Payment',
            'partner_id' => 'Partner ID',
        ];
    }
}
