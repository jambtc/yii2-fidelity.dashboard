<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nodes}}`.
 */
class m210415_084338_create_nodes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nodes}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'port' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nodes}}');
    }
}
