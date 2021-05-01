<?php

use yii\db\Migration;

/**
 * Class m210417_202015_update_stores_table
 */
class m210417_202015_update_stores_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('stores', 'id_blockchain', $this->integer(11)->after('id_merchant'));

        // creates index for column `id_blockchain`
        $this->createIndex(
           '{{%idx-stores-id_blockchain}}',
           '{{%stores}}',
           'id_blockchain'
        );

        // add foreign key for table `{{%stores}}`
        $this->addForeignKey(
            '{{%fk-id_blockchain}}',
            '{{%stores}}',
            'id_blockchain',
            '{{%blockchains}}',
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
            '{{%fk-id_blockchain}}',
            '{{%stores}}'
        );

        // drops index for column `id_blockchain`
        $this->dropIndex(
            '{{%idx-stores-id_blockchain}}',
            '{{%stores}}'
        );

        $this->dropColumn('stores', 'id_blockchain');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210417_202015_update_stores_table cannot be reverted.\n";

        return false;
    }
    */
}
