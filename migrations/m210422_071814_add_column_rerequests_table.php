<?php

use yii\db\Migration;

/**
 * Class m210422_071814_add_column_rerequests_table
 */
class m210422_071814_add_column_rerequests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('re_requests', 'id_store', $this->integer(11)->notNull()->after('id_merchant'));

        // creates index for column `id_store`
        $this->createIndex(
           '{{%idx2-re_requests-id_store}}',
           '{{%re_requests}}',
           'id_store'
        );


        // add foreign key for table `{{%re_requests}}`
        $this->addForeignKey(
            '{{%fk-re_requests-id_store}}',
            '{{%re_requests}}',
            'id_store',
            '{{%stores}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%re_requests}}`
        $this->dropForeignKey(
            '{{%fk-re_requests-id_store}}',
            '{{%re_requests}}'
        );


        // drops index for column `id_store`
        $this->dropIndex(
            '{{%idx-re_requests-id_store}}',
            '{{%re_requests}}'
        );


        $this->dropColumn('re_requests', 'id_store');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210422_071814_add_column_rerequests_table cannot be reverted.\n";

        return false;
    }
    */
}
