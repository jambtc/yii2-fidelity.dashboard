<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apikeys}}`.
 */
class m210412_132801_create_apikeys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apikeys}}', [
            'id' => $this->primaryKey(),
            'id_merchant' => $this->integer(11)->notNull(),
            'id_store' => $this->integer(11)->notNull(),
            'denomination' => $this->string(255)->notNull(),
            'public_key' => $this->string(255)->notNull(),
            'secret_key' => $this->string(255)->notNull(),
        ]);

        // creates index for column `id_merchant`
        $this->createIndex(
           '{{%idx-apikeys-id_merchant}}',
           '{{%apikeys}}',
           'id_merchant'
        );

        // creates index for column `id_store`
        $this->createIndex(
           '{{%idx-apikeys-id_store}}',
           '{{%apikeys}}',
           'id_store'
        );

        // add foreign key for table `{{%apikeys}}`
        $this->addForeignKey(
            '{{%fk-apikeys-id_merchant}}',
            '{{%apikeys}}',
            'id_merchant',
            '{{%merchants}}',
            'id',
            'CASCADE'
        );

        // add foreign key for table `{{%apikeys}}`
        $this->addForeignKey(
            '{{%fk-apikeys-id_store}}',
            '{{%apikeys}}',
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
        // drops foreign key for table `{{%stores}}`
        $this->dropForeignKey(
            '{{%fk-apikeys-id_merchant}}',
            '{{%apikeys}}'
        );

        // drops foreign key for table `{{%stores}}`
        $this->dropForeignKey(
            '{{%fk-apikeys-id_store}}',
            '{{%apikeys}}'
        );

        // drops index for column `id_merchant`
        $this->dropIndex(
            '{{%idx-apikeys-id_merchant}}',
            '{{%apikeys}}'
        );

        // drops index for column `id_merchant`
        $this->dropIndex(
            '{{%idx-apikeys-id_store}}',
            '{{%apikeys}}'
        );

        $this->dropTable('{{%apikeys}}');
    }
}
