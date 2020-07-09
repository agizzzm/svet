<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m200709_163417_add_partners_column_to_user_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'partners_ids', $this->string()->null()->comment('ID партнеров'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'partners_ids');
    }
}
