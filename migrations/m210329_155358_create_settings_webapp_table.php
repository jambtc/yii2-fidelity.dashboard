<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings_webapp}}`.
 */
class m210329_155358_create_settings_webapp_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings_webapp}}', [
            'id' => $this->primaryKey(),
            'setting_name' => $this->string(20)->notNull(),
            'setting_value' => $this->string(10000)->notNull(),
        ]);

        $this->insert('{{%settings_webapp}}', [
            'setting_name' => 'version',
            'setting_value' => '0000-0000',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings_webapp}}');
    }
}
