<?php

use yii\db\Migration;

/**
 * Handles the creation of table `banner`.
 */
class m180311_120956_create_banner_table extends Migration
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

        $this->createTable('{{%banners}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image_id' => $this->integer(),
            'link' => $this->string()
        ],$tableOptions);

        $this->createTable('{{%banners_pages_via}}', [
            'banner_id' => $this->integer()->notNull(),
            'page_id' => $this->integer()->notNull()
        ],$tableOptions);

        $this->addForeignKey('fk-banners-image_id', '{{%banners}}','image_id','{{%files}}','id','SET NULL','CASCADE');

        $this->addPrimaryKey('pk-banners_pages_via', '{{%banners_pages_via}}', ['banner_id', 'page_id']);

        $this->createIndex('idx-banners_pages_via-banner_id', '{{%banners_pages_via}}', 'banner_id');
        $this->createIndex('idx-banners_pages_via-page_id', '{{%banners_pages_via}}', 'page_id');

        $this->addForeignKey('fk-banners_pages_via-banner_id', '{{%banners_pages_via}}', 'banner_id', '{{%banners}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-banners_pages_via-page_id', '{{%banners_pages_via}}', 'page_id', '{{%pages}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%banners_pages_via}}');
        $this->dropTable('{{%banners}}');
    }
}
