<?php

use yii\db\Migration;

/**
 * Handles the creation of table `block_carousel`.
 */
class m171229_090701_create_block_carousel_table extends Migration
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

        $this->createTable('block_carousel', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'color' => $this->string(7)->notNull(),
            'pos' => $this->integer()->notNull()->defaultValue(0)
        ],$tableOptions);

        $this->createTable('{{%block_carousel_images}}', [
            'id' => $this->primaryKey(),
            'block_carousel_id' => $this->integer()->notNull(),
            'name' => $this->string(512)->notNull(),
            'alt' => $this->string(512)->notNull(),
            'title' => $this->string(512)->notNull(),
            'basename' => $this->string(256)->notNull(),
            'link' => $this->string(512)->notNull(),
            'caption' => $this->text()->notNull(),
            'ext' => $this->string(5)->notNull(),
            'publish' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'pos' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'fk-block_carousel_images-block_carousel_id',
            '{{%block_carousel_images}}',
            'block_carousel_id',
            '{{%block_carousel}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('block_carousel');
    }
}
