<?php

use yii\db\Migration;

class m160503_081612_form extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%form}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(128)->notNull(),
            'sys_name' => $this->string(64)->notNull()->unique(),
            'css' => $this->string(32)->notNull(),
            'name' => $this->string(512)->notNull(),
            'email' => $this->string(256)->notNull(),
            'theme' => $this->string(512)->notNull(),
            'submit_btn_text' => $this->string(128)->notNull(),
            'submit_success' => $this->string(512)->notNull(),
            'event' => $this->string(512)->notNull(),
            'json_schema' => $this->text()->notNull(),
            'captcha' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'images_on' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'show_name' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'image_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ],$tableOptions);

        $this->createIndex('idx-form-sys_name', '{{%form}}', 'sys_name');

    }

    public function down()
    {
        $this->dropTable('{{%form}}');
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
