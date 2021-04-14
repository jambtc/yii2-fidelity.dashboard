<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notifications_readers}}`.
 */
class m210414_103923_create_notifications_readers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notifications_readers}}', [
            'id' => $this->primaryKey(),
            'id_notification' => $this->integer(11)->notNull(),
            'id_user' => $this->integer(11)->notNull(),
            'alreadyread' => $this->boolean(0)->notNull(),
        ]);

        // creates index for column `id_notification`
        $this->createIndex(
           '{{%idx-notifications_readers-id_notification}}',
           '{{%notifications_readers}}',
           'id_notification'
        );

        // creates index for column `id_store`
        $this->createIndex(
           '{{%idx-notifications_readers-id_user}}',
           '{{%notifications_readers}}',
           'id_user'
        );

        // add foreign key for table `{{%notifications_readers}}`
        $this->addForeignKey(
            '{{%fk-notifications_readers-id_notification}}',
            '{{%notifications_readers}}',
            'id_notification',
            '{{%notifications}}',
            'id',
            'CASCADE'
        );

        // add foreign key for table `{{%notifications_readers}}`
        $this->addForeignKey(
            '{{%fk-notifications_readers-id_user}}',
            '{{%notifications_readers}}',
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
            // drops foreign key for table `{{%stores}}`
        $this->dropForeignKey(
            '{{%fk-notifications_readers-id_notification}}',
            '{{%notifications_readers}}'
        );

        // drops foreign key for table `{{%stores}}`
        $this->dropForeignKey(
            '{{%fk-notifications_readers-id_user}}',
            '{{%notifications_readers}}'
        );

        // drops index for column `id_merchant`
        $this->dropIndex(
            '{{%idx-notifications_readers-id_notification}}',
            '{{%notifications_readers}}'
        );

        // drops index for column `id_merchant`
        $this->dropIndex(
            '{{%idx-notifications_readers-id_user}}',
            '{{%notifications_readers}}'
        );

        $this->dropTable('{{%notifications_readers}}');
    }
}
