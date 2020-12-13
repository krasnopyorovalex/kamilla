<?php

use yii\db\Migration;

class m160505_130303_menu extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'sys_name' => $this->string(128)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->createTable('{{%menu_items}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'link' => $this->string(512)->notNull(),
            'icon' => $this->string(128),
            'pos' => $this->integer()->notNull()->defaultValue(0),
            'parent_id' => $this->integer(),
            'menu_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->createIndex('idx-menu-sys_name','{{%menu}}','sys_name');
        $this->createIndex('idx-menu-parent_id','{{%menu_items}}','parent_id');

        $this->addForeignKey('fk-menu-menu', '{{%menu_items}}','menu_id','{{%menu}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk-menu-parent', '{{%menu_items}}','parent_id','{{%menu_items}}','id','CASCADE','RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%menu}}');
        $this->dropTable('{{%menu_items}}');
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
