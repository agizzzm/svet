<?php

namespace common\models\repositories;

class OrderRepository extends \common\models\db\Order
{
    public $_client = null;

    /**
     * @return OrderRepository[]|[]
     */
    public static function getAll()
    {
        return self::find()->all();
    }

    /**
     * @param int $client_id
     * @return OrderRepository[]|[]
     */
    public static function getByClient(int $client_id)
    {
        return self::find()->where(['client_id' => $client_id])->all();
    }

    /**
     * @param int $client_id
     * @return OrderRepository[]|[]
     */
    public static function getById(int $id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * @return ClientRepository|null
     */
    public function getClient()
    {
        if ($this->_client == null) {
            $this->_client = $this->hasOne(ClientRepository::class, ['id' => 'client_id'])->one();
        }

        return $this->_client;
    }

    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'client_id' => 'Клиент',
            'cost'      => 'Сумма платежа',
        ];
    }
}
