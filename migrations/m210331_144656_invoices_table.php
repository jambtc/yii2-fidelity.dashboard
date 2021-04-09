<?php

use yii\db\Migration;

/**
 * Class m210331_144656_invoices_table
 */
class m210331_144656_invoices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoices}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(11)->notNull(),
            'status' => $this->string(20)->notNull(),
            'price' => $this->float()->notNull(),
            'received' => $this->float()->notNull(),
            'id_pos' => $this->integer(11)->notNull(),
            'invoice_timestamp' => $this->integer(11)->notNull(),
            'expiration_timestamp' => $this->integer(11)->notNull(),
            'from_address' => $this->string(100),
            'to_address' => $this->string(100),
            'txhash' => $this->string(250),
        ]);

        // creates index for column `id_user`
       $this->createIndex(
           '{{%idx-invoices-id_user}}',
           '{{%invoices}}',
           'id_user'
       );

        // add foreign key for table `{{%push_subscriptions}}`
        $this->addForeignKey(
            '{{%fk-id_invoices}}',
            '{{%invoices}}',
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
        // drops foreign key for table `{{%push_subscriptions}}`
        $this->dropForeignKey(
            '{{%fk-id_invoices}}',
            '{{%invoices}}'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            '{{%idx-invoices-id_user}}',
            '{{%invoices}}'
        );

        $this->dropTable('{{%invoices}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210331_144656_invoices_table cannot be reverted.\n";

        return false;
    }
    */
}
