<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%partners_branches}}`.
 */
class m200709_181449_add_coor_column_to_partners_branches_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%partners_branches}}', 'coor', $this->string()->null()->comment('Координаты на карте'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%partners_branches}}', 'coor');
    }
}
