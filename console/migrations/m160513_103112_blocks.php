<?php

use yii\db\Migration;

class m160513_103112_blocks extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blocks}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'sys_name' => $this->string(128)->notNull(),
            'text' => $this->text(),
            'publish' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->createIndex('idx-blocks-sys_name', '{{%blocks}}', 'sys_name');
    }

    public function down()
    {
        $this->dropTable('{{%blocks}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
