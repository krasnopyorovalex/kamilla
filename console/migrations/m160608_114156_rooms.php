<?php

use yii\db\Migration;

class m160608_114156_rooms extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%rooms}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slogan' => $this->string(),
            'alias' => $this->string(128)->notNull(),
            'title' => $this->string(512)->notNull(),
            'description' => $this->string(512)->notNull(),
            'keywords' => $this->string(512)->notNull(),
            'text' => $this->text(),
            'text_preview' => $this->text(),
            'price' => $this->string(512)->notNull(),
            'image_id' => $this->integer(),
            'image_main_preview_id' => $this->integer(),
            'image_preview_id' => $this->integer(),
            'gallery_id' => $this->integer(),
            'publish' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'show_in_main' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'menu_name' => $this->string(),
            'pos' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ],$tableOptions);

        $this->createIndex('idx-rooms-alias', '{{%rooms}}', 'alias', true);

        $this->addForeignKey('fk-rooms-gallery_id', '{{%rooms}}', 'gallery_id', '{{%gallery}}', 'id', 'SET NULL', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%rooms}}');
        return false;
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
