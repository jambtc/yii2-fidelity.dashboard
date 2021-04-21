<?php

use yii\db\Migration;

/**
 * Class m210419_123318_add_fk_update_invoices_table
 */
class m210419_123318_add_fk_update_invoices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // creates index for column `id_pos`
        $this->createIndex(
           '{{%idx-invoices-id_pos}}',
           '{{%invoices}}',
           'id_pos'
        );

        // add foreign key for table `{{%invoices}}`
        $this->addForeignKey(
            '{{%fk-id_pos}}',
            '{{%invoices}}',
            'id_pos',
            '{{%pos}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%invoices}}`
        $this->dropForeignKey(
            '{{%fk-id_pos}}',
            '{{%invoices}}'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            '{{%idx-invoices-id_pos}}',
            '{{%invoices}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210419_123318_add_fk_update_invoices_table cannot be reverted.\n";

        return false;
    }
    */
}
