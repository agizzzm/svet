<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%clients}}`.
 */
class m200806_130054_add_partner_id_column_to_clients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%clients}}', 'partner_id', $this->integer(11)->null()->comment('Партнер'));

        $this->createIndex('idx_clients_partner_id', '{{%clients}}', 'partner_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%clients}}', 'partner_id');
    }
}
