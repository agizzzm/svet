<?php

namespace common\models\repositories;

class OrderRepository extends \common\models\db\Order
{
    public $client;

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
        if ($this->client == null) {
            $this->client = $this->hasOne(ClientRepository::class, ['id' => 'client_id'])->one();
        }

        return $this->client;
    }
}
