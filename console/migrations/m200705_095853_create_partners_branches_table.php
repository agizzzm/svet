<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partners_branches}}`.
 */
class m200705_095853_create_partners_branches_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partners_branches}}', [
            'id'         => $this->primaryKey(),
            'partner_id' => $this->integer()->notNull()->comment('Партнер'),
            'address'    => $this->text()->notNull()->comment('Адрес'),
            'category'   => $this->string()->notNull()->comment('Категория'),
            'cost'       => $this->decimal(10, 2)->notNull()->comment('Стоимость'),
        ]);

        $this->createIndex('idx_partners_branches_category', '{{%partners_branches}}', 'category');
        $this->createIndex('idx_partners_branches_cost', '{{%partners_branches}}', 'cost');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%partners_branches}}');
    }
}
