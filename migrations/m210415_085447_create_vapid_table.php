<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vapid}}`.
 */
class m210415_085447_create_vapid_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vapid}}', [
            'id' => $this->primaryKey(),
            'public_key' => $this->string(255)->notNull(),
            'secret_key' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vapid}}');
    }
}
