<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%partners}}`.
 */
class m200806_095637_add_inn_ur_address_column_to_partners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%partners}}', 'inn', $this->string(40)->null()->comment('ИНН'));
        $this->addColumn('{{%partners}}', 'ur_address', $this->text()->null()->comment('Юридический адрес'));

        $this->createIndex('idx_partners_inn', '{{%partners}}', 'inn');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_partners_inn', '{{%partners}}');

        $this->dropColumn('{{%partners}}', 'inn');
    }
}
