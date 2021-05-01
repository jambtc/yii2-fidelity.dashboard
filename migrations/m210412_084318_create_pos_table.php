<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pos}}`.
 */
class m210412_084318_create_pos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pos}}', [
            'id' => $this->primaryKey(),
            'id_merchant' => $this->integer(11)->notNull(),
            'id_store' => $this->integer(11)->notNull(),
            'denomination' => $this->string(255)->notNull(),
            'sin' => $this->string(255)->notNull(),
        ]);

        // creates index for column `id_merchant`
        $this->createIndex(
           '{{%idx-pos-id_merchant}}',
           '{{%pos}}',
           'id_merchant'
        );

        // creates index for column `id_store`
        $this->createIndex(
           '{{%idx-pos-id_store}}',
           '{{%pos}}',
           'id_store'
        );

        // add foreign key for table `{{%pos}}`
        $this->addForeignKey(
            '{{%fk-id_merchant}}',
            '{{%pos}}',
            'id_merchant',
            '{{%merchants}}',
            'id',
            'CASCADE'
        );

        // add foreign key for table `{{%pos}}`
        $this->addForeignKey(
            '{{%fk-id_store}}',
            '{{%pos}}',
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
            '{{%fk-id_merchant}}',
            '{{%pos}}'
        );

        // drops foreign key for table `{{%stores}}`
        $this->dropForeignKey(
            '{{%fk-id_store}}',
            '{{%pos}}'
        );

        // drops index for column `id_merchant`
        $this->dropIndex(
            '{{%idx-pos-id_merchant}}',
            '{{%pos}}'
        );

        // drops index for column `id_merchant`
        $this->dropIndex(
            '{{%idx-pos-id_store}}',
            '{{%pos}}'
        );

        $this->dropTable('{{%pos}}');
    }
}
