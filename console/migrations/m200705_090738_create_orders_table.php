<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m200705_090738_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id'        => $this->primaryKey(),
            'client_id' => $this->integer()->null()->comment('Клиент'),
            'cost'      => $this->decimal(10, 2)->null()->comment('Оплата'),
        ]);

        $this->createIndex('idx_orders_client_id', '{{%orders}}', 'client_id');
        $this->createIndex('idx_orders_cost', '{{%orders}}', 'cost');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
