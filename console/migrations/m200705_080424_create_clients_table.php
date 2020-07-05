<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%clients}}`.
 */
class m200705_080424_create_clients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%clients}}', [
            'id'            => $this->primaryKey(),
            'lastname'      => $this->string()->null()->comment('Фамилия'),
            'firstname'     => $this->string()->null()->comment('Имя'),
            'middlename'    => $this->string()->null()->comment('Отчество'),
            'phone'         => $this->string()->null()->comment('Телефон'),
            'email'         => $this->string()->null()->comment('Email'),
            'category_id'   => $this->integer()->null()->comment('Категория'),
            'cost'          => $this->decimal(10, 2)->null()->comment('Стоимость'),
            'first_payment' => $this->decimal(10, 2)->null()->comment('Первый взнос'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%clients}}');
    }
}
