<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $contact Контатное лицо
 * @property string $contact_phone Контатный телефон
 * @property string $email Email
 * @property string $region Регион
 * @property string $city Город
 * @property string|null $inn ИНН
 * @property string|null $ur_address Юридический адрес
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'contact', 'contact_phone', 'email', 'region', 'city'], 'required'],
            [['ur_address'], 'string'],
            [['name', 'contact', 'contact_phone', 'email', 'region', 'city'], 'string', 'max' => 255],
            [['inn'], 'string', 'max' => 40],
            [['contact_phone'], 'unique'],
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
            'name' => 'Name',
            'contact' => 'Contact',
            'contact_phone' => 'Contact Phone',
            'email' => 'Email',
            'region' => 'Region',
            'city' => 'City',
            'inn' => 'Inn',
            'ur_address' => 'Ur Address',
        ];
    }
}
