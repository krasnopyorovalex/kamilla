<?php

use yii\db\Migration;

class m160507_080839_gallery extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'sys_name' => $this->string(64)->notNull(),
            'name' => $this->string(512)->notNull(),
            'title' => $this->string(512)->notNull(),
            'description' => $this->string(512)->notNull(),
            'keywords' => $this->string(512)->notNull(),
            'text_above' => $this->text(),
            'text_below' => $this->text(),
            'alias' => $this->string()->notNull(),
            'view_in_gallery' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'publish' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'pos' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->createTable('{{%gallery_images}}', [
            'id' => $this->primaryKey(),
            'gallery_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'alt' => $this->string(),
            'title' => $this->string(),
            'basename' => $this->string(256)->notNull(),
            'ext' => $this->string(5)->notNull(),
            'publish' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'pos' => $this->integer()->notNull()->defaultValue(0)
        ], $tableOptions);

        $this->createIndex('idx-gallery-alias', '{{%gallery}}', 'alias', true);
        $this->createIndex('idx-gallery_images-gallery_id', '{{%gallery_images}}', 'gallery_id');
        $this->addForeignKey('fk-gallery_images-gallery_id', '{{%gallery_images}}','gallery_id','{{%gallery}}','id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%gallery}}');
        $this->dropTable('{{%gallery_images}}');
    }
}
