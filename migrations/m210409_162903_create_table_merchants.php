<?php

use yii\db\Migration;

/**
 * Class m210409_162903_create_table_merchants
 */
class m210409_162903_create_table_merchants extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%merchants}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(11)->notNull(),
            'denomination' => $this->string(255)->defaultValue(NULL),
            'tax_code' => $this->string(50)->defaultValue(NULL),
            'address' => $this->string(255)->defaultValue(NULL),
            'cap' => $this->string(10)->defaultValue(NULL),
            'city' => $this->string(255)->defaultValue(NULL),
            'country' => $this->string(255)->defaultValue(NULL),
        ]);

        // creates index for column `id_user`
       $this->createIndex(
           '{{%idx-merchants-id_user}}',
           '{{%merchants}}',
           'id_user'
       );

        // add foreign key for table `{{%merchants}}`
        $this->addForeignKey(
            '{{%fk-id_merchants}}',
            '{{%merchants}}',
            'id_user',
            '{{%users}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%merchants}}`
        $this->dropForeignKey(
            '{{%fk-id_merchants}}',
            '{{%merchants}}'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            '{{%idx-merchants-id_user}}',
            '{{%merchants}}'
        );

        $this->dropTable('{{%merchants}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210409_162903_create_table_merchants cannot be reverted.\n";

        return false;
    }
    */
}
