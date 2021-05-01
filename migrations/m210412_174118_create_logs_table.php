<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%logs}}`.
 */
class m210412_174118_create_logs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%logs}}', [
            'id' => $this->primaryKey(),
            'timestamp' => $this->integer(11)->notNull(),
            'id_user' => $this->integer(11),
            'remote_address' => $this->string(20)->notNull(),
            'browser' => $this->string(255)->notNull(),
            'app' => $this->string(50)->notNull(),
            'controller' => $this->string(50)->notNull(),
            'action' => $this->string(50)->notNull(),
            'description' => $this->text()->notNull(),
            'die' => $this->boolean(),
        ]);

        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%logs}}');
    }
}
