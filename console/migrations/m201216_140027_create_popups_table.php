<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%popups}}`.
 */
class m201216_140027_create_popups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%popups}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%popups}}');
    }
}
