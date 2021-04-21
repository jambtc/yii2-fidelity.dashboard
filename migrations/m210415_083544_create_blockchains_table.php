<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blockchains}}`.
 */
class m210415_083544_create_blockchains_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blockchains}}', [
            'id' => $this->primaryKey(),
            'denomination' => $this->string(255)->notNull(),
            'invoice_expiration' => $this->integer(11)->notNull(),
            'smart_contract_address' => $this->string(255)->notNull(),
            'chain_id' => $this->string(50)->notNull(),
            'url_block_explorer' => $this->string(255)->notNull(),
            'smart_contract_abi' => $this->text()->notNull(),
            'smart_contract_bytecode' => $this->text()->notNull(),
            'sealer_address' => $this->string(255)->notNull(),
            'sealer_private_key' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blockchains}}');
    }
}
