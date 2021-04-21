<?php

use yii\db\Migration;

/**
 * Class m210417_194532_update_blockchains_table
 */
class m210417_194532_update_blockchains_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('blockchains', 'decimals', $this->integer(11)->after('smart_contract_address'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('blockchains', 'decimals');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210417_194532_update_blockchains_table cannot be reverted.\n";

        return false;
    }
    */
}
