<?php

use yii\db\Migration;

class m160516_062010_currency extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'iso' => $this->string(3)->notNull(),
            'exchange' => $this->float()
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%currency}}');
    }
}
