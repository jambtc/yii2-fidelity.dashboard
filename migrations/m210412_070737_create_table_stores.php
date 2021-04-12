<?php

use yii\db\Migration;

/**
 * Class m210412_070737_create_table_stores
 */
class m210412_070737_create_table_stores extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stores}}', [
            'id' => $this->primaryKey(),
            'id_merchant' => $this->integer(11)->notNull(),
            'denomination' => $this->string(255)->notNull(),
            'bps_storeid' => $this->string(255)->notNull(),
        ]);

        // creates index for column `id_merchant`
       $this->createIndex(
           '{{%idx-stores-id_merchant}}',
           '{{%stores}}',
           'id_merchant'
       );

        // add foreign key for table `{{%merchants}}`
        $this->addForeignKey(
            '{{%fk-id_stores}}',
            '{{%stores}}',
            'id_merchant',
            '{{%merchants}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%stores}}`
        $this->dropForeignKey(
            '{{%fk-id_stores}}',
            '{{%stores}}'
        );

        // drops index for column `id_merchant`
        $this->dropIndex(
            '{{%idx-stores-id_merchant}}',
            '{{%stores}}'
        );

        $this->dropTable('{{%stores}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210412_070737_create_table_stores cannot be reverted.\n";

        return false;
    }
    */
}
