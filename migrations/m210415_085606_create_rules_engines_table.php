<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rules_engines}}`.
 */
class m210415_085606_create_rules_engines_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rules_engines}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'public_key' => $this->string(255)->notNull(),
            'secret_key' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rules_engines}}');
    }
}
