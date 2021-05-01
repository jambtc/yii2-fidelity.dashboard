<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%host}}`.
 */
class m210415_083035_create_host_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%host}}', [
            'id' => $this->primaryKey(),
            'tcpip' => $this->string(255)->notNull(),
            'user' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%host}}');
    }
}
