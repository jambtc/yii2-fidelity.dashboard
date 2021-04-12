<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210329_153813_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'activation_code' => $this->string(50)->defaultValue(NULL),
            'status_activation_code' => $this->integer(11)->defaultValue(0),
            'authKey' => $this->string(255)->defaultValue(NULL),
            'accessToken' => $this->string(255)->defaultValue(NULL),
            'first_name' => $this->string(255)->defaultValue(NULL),
            'last_name' => $this->string(255)->defaultValue(NULL),
            'email' => $this->string(255)->defaultValue(NULL),
            'is_merchant' => $this->boolean()->defaultValue(0),
            'denomination' => $this->string(255)->defaultValue(NULL),
            'tax_code' => $this->string(50)->defaultValue(NULL),
            'address' => $this->string(255)->defaultValue(NULL),
            'cap' => $this->string(10)->defaultValue(NULL),
            'city' => $this->string(255)->defaultValue(NULL),
            'country' => $this->string(255)->defaultValue(NULL),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
