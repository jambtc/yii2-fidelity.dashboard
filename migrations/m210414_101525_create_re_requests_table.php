<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%re_requests}}`.
 */
class m210414_101525_create_re_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%re_requests}}', [
            'id' => $this->primaryKey(),
            'timestamp' => $this->integer(11)->notNull(),
            'id_merchant' => $this->integer(11)->notNull(),
            'payload' => $this->text()->notNull(),
            'sent' => $this->boolean()->notNull(0),
        ]);

        // creates index for column `id_merchant`
        $this->createIndex(
           '{{%idx-re_requests-id_merchant}}',
           '{{%re_requests}}',
           'id_merchant'
        );

        // add foreign key for table `{{%apikeys}}`
        $this->addForeignKey(
            '{{%fk-re_requests-id_merchant}}',
            '{{%re_requests}}',
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
            '{{%fk-re_requests-id_merchant}}',
            '{{%re_requests}}'
        );

        // drops index for column `id_merchant`
        $this->dropIndex(
            '{{%idx-re_requests-id_merchant}}',
            '{{%re_requests}}'
        );

        $this->dropTable('{{%re_requests}}');
    }
}
