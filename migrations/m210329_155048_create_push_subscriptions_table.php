<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%push_subscriptions}}`.
 */
class m210329_155048_create_push_subscriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%push_subscriptions}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(11),
            'type' => $this->string(20)->notNull(),
            'browser' => $this->string(1000)->notNull(),
            'endpoint' => $this->string(1000)->notNull(),
            'auth' => $this->string(1000)->notNull(),
            'p256dh' => $this->string(1000)->notNull(),
        ]);

        // creates index for column `id_user`
       $this->createIndex(
           '{{%idx-push-id_user}}',
           '{{%push_subscriptions}}',
           'id_user'
       );

        // add foreign key for table `{{%push_subscriptions}}`
        $this->addForeignKey(
            '{{%fk-id_subscription}}',
            '{{%push_subscriptions}}',
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
            '{{%fk-id_subscription}}',
            '{{%push_subscriptions}}'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            '{{%idx-push-id_user}}',
            '{{%push_subscriptions}}'
        );

        $this->dropTable('{{%push_subscriptions}}');
    }
}
