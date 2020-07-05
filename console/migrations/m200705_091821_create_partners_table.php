<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partners}}`.
 */
class m200705_091821_create_partners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partners}}', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string()->notNull()->comment('Наименование'),
            'contact'       => $this->string()->notNull()->comment('Контатное лицо'),
            'contact_phone' => $this->string()->notNull()->unique()->comment('Контатный телефон'),
            'email'         => $this->string()->notNull()->unique()->comment('Email'),
            'region'        => $this->string()->notNull()->comment('Регион'),
            'city'          => $this->string()->notNull()->comment('Город'),
        ]);

        $this->createIndex('idx_partners_contact_phone', '{{%partners}}', 'contact_phone');
        $this->createIndex('idx_partners_contact_email', '{{%partners}}', 'email');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%partners}}');
    }
}
