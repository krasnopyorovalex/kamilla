<?php

use yii\db\Migration;

class m160514_073559_redirects extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%redirects}}', [
            'id' => $this->primaryKey(),
            'old_alias' => $this->string(512)->notNull(),
            'new_alias' => $this->string(512)->notNull(),
            'code' => $this->smallInteger(3)->defaultValue(301),
            'date' => $this->integer()->notNull()
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%redirects}}');
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
