<?php

use yii\db\Migration;

/**
 * Class m210419_103250_add_column_invoices_table
 */
class m210419_103250_add_column_invoices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('invoices', 'message', $this->text(1000)->after('txhash'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('invoices', 'message');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210419_103250_add_column_invoices_table cannot be reverted.\n";

        return false;
    }
    */
}
