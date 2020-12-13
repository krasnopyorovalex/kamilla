<?php

use yii\db\Migration;

/**
 * Handles the creation of table `files`.
 */
class m180304_093833_create_files_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'path' => $this->string()->notNull(),
            'title' => $this->string(),
            'alt' => $this->string()
        ], $tableOptions);

        $this->addForeignKey('fk-pages-image_id', '{{%pages}}','image_id','{{%files}}','id','SET NULL','CASCADE');

        $this->addForeignKey('fk-rooms-image_id', '{{%rooms}}','image_id','{{%files}}','id','SET NULL','CASCADE');
        $this->addForeignKey('fk-rooms-image_main_preview_id', '{{%rooms}}','image_main_preview_id','{{%files}}','id','SET NULL','CASCADE');
        $this->addForeignKey('fk-rooms-image_preview_id', '{{%rooms}}','image_preview_id','{{%files}}','id','SET NULL','CASCADE');

        $this->addForeignKey('fk-news-image_preview_id', '{{%news}}','image_preview_id','{{%files}}','id','SET NULL','CASCADE');
        $this->addForeignKey('fk-news-image_header_id', '{{%news}}','image_header_id','{{%files}}','id','SET NULL','CASCADE');

        $this->addForeignKey('fk-articles-image_preview_id', '{{%articles}}','image_preview_id','{{%files}}','id','SET NULL','CASCADE');
        $this->addForeignKey('fk-articles-image_header_id', '{{%articles}}','image_header_id','{{%files}}','id','SET NULL','CASCADE');

        $this->addForeignKey('fk-specials-image_preview_id', '{{%specials}}','image_preview_id','{{%files}}','id','SET NULL','CASCADE');
        $this->addForeignKey('fk-specials-image_header_id', '{{%specials}}','image_header_id','{{%files}}','id','SET NULL','CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('files');
    }
}
