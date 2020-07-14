<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%partners_branches}}`.
 */
class m200714_131808_add_metro_column_to_partners_branches_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%partners_branches}}', 'metro', $this->text()->null()->comment('Ближайщие метро'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%partners_branches}}', 'metro');
    }
}
