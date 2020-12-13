<?php

use yii\db\Migration;

class m160427_115820_pages extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'template' => $this->string(32),
            'name' => $this->string()->notNull(),
            'slogan' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'keywords' => $this->string(),
            'text' => $this->text(),
            'alias' => $this->string()->notNull(),
            'image_id' => $this->integer(),
            'name_is_h1' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'galleries' => $this->string(),
            'carousel_id' => $this->integer(),
            'publish' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->createIndex('idx-pages-alias', '{{%pages}}', 'alias', true);
        $this->createIndex('idx-pages-parent_id', '{{%pages}}', 'parent_id');

        $this->addForeignKey('fk-pages-parent', '{{%pages}}', 'parent_id', '{{%pages}}', 'id', 'SET NULL', 'RESTRICT');

        $this->insert('{{%pages}}', [
            'name'        => 'Hillter',
            'title'       => 'Hillter',
            'description' => 'Hillter',
            'keywords'    => 'Hillter',
            'text'        => 'Текст главной страницы - Hillter',
            'alias'       => 'index',
            'template'    => 'index.twig',
            'created_at'  => time(),
            'updated_at'  => time()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%pages}}');
    }
}
