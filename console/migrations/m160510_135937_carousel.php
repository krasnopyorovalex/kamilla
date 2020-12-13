<?php

use yii\db\Migration;

class m160510_135937_carousel extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%carousel}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'video' => $this->string(128),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->createTable('{{%carousel_images}}', [
            'id' => $this->primaryKey(),
            'carousel_id' => $this->integer()->notNull(),
            'name' => $this->string(512),
            'text_top' => $this->string(512),
            'text_middle' => $this->string(512),
            'text_btn' => $this->string(512),
            'link' => $this->string(512),
            'alt' => $this->string(512),
            'title' => $this->string(512),
            'basename' => $this->string(256)->notNull(),
            'ext' => $this->string(5)->notNull(),
            'publish' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'pos' => $this->integer()->notNull()->defaultValue(0)
        ], $tableOptions);

        $this->createIndex('idx-carousel_images-carousel_id', '{{%carousel_images}}', 'carousel_id');
        $this->addForeignKey('fk-carousel_images-carousel_id', '{{%carousel_images}}','carousel_id','{{%carousel}}','id','CASCADE','CASCADE');

        $this->addForeignKey('fk-pages-carousel_id', '{{%pages}}', 'carousel_id', '{{%carousel}}', 'id', 'SET NULL', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%carousel}}');
        $this->dropTable('{{%carousel_images}}');
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
