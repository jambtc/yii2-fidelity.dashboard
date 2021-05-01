<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%owner}}`.
 */
class m210415_081241_create_owner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%owner}}', [
            'id' => $this->primaryKey(),
            'owner' => $this->string(255)->notNull(),
            'tax_code' => $this->string(50)->notNull(),
            'address' => $this->string(255)->notNull(),
            'cap' => $this->string(20)->notNull(),
            'city' => $this->string(255)->notNull(),
            'country' => $this->string(255)->notNull(),
            'phone' => $this->string(50)->notNull(),
            'email' => $this->string(255)->notNull(),
            'dpo_officer' => $this->string(255)->notNull(),
            'dpo_email' => $this->string(255)->notNull(),
            'dpo_phone' => $this->string(255)->notNull(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%owner}}');
    }
}
