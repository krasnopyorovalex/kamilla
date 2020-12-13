<?php

use yii\db\Migration;

class m160429_171608_specials extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%specials}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'slogan' => $this->string(),
            'title' => $this->string(512)->notNull(),
            'description' => $this->string(512),
            'keywords' => $this->string(512),
            'text' => $this->text(),
            'text_preview' => $this->text(),
            'alias' => $this->string()->notNull(),
            'image_preview_id' => $this->integer(),
            'image_header_id' => $this->integer(),
            'date' => $this->date()->notNull(),
            'galleries' => $this->string(),
            'publish' => $this->smallInteger(1)->notNull()->defaultValue(1)
        ],$tableOptions);

        $this->createIndex('idx-specials-alias', '{{%specials}}', 'alias', true);
    }

    public function down()
    {
        $this->dropTable('{{%specials}}');
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
