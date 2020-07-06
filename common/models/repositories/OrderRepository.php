<?php

namespace common\models\repositories;

class OrderRepository extends \common\models\db\Order
{
    public $_client;

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
     * @return ClientRepository|null
     */
    public function getClient()
    {
        if ($this->_client == null) {
            $this->_client = $this->hasOne(ClientRepository::class, ['id' => 'client_id'])->one();
        }

        return $this->_client;
    }
}
