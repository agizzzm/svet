<?php

namespace common\models\repositories;

class ClientRepository extends \common\models\db\Client
{
    public $_orders = null;
    public $_category = null;

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
     * @param string $phone
     * @return ClientRepository|null
     */
    public static function getById(int $id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * @param string $email
     * @return ClientRepository|null
     */
    public static function getByEmail(string $email)
    {
        return self::find()->where(['email' => $email])->one();
    }

    /**
     * @return OrderRepository[]|[]
     */
    public function getOrders()
    {
        if ($this->_orders == null) {
            $this->_orders = $this->hasMany(OrderRepository::class, ['order_id' => 'id'])->all();
        }

        return $this->_orders;
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
            'id'            => 'ID',
            'lastname'      => 'Фамилия',
            'firstname'     => 'Имя',
            'middlename'    => 'Отчество',
            'phone'         => 'Телефон',
            'email'         => 'Email',
            'category_id'   => 'Категория',
            'cost'          => 'Стоимость',
            'first_payment' => 'Первый взнос',
        ];
    }
}
