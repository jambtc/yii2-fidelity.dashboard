<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notifications}}`.
 */
class m210414_103323_create_notifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notifications}}', [
            'id' => $this->primaryKey(),
            'timestamp' => $this->integer(11)->notNull(),
            'type' => $this->string(50)->notNull(),
            'status' => $this->string(50)->notNull(),
            'description' => $this->text()->notNull(),
            'url' => $this->text(500)->notNull(),
            'price' => $this->float()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notifications}}');
    }
}
