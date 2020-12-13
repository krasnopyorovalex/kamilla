<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price`.
 */
class m170920_062913_create_price_table extends Migration
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
        $this->createTable('price', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'description' => $this->text(),
            'image' => $this->string(512),
            'gallery_id' => $this->integer(),
            'room_id' => $this->integer(),
            'pos' => $this->integer()->defaultValue(0)
        ],$tableOptions);

        $this->addForeignKey('fk-price-gallery_id', '{{%price}}', 'gallery_id', '{{%gallery}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-price-room_id', '{{%price}}', 'room_id', '{{%rooms}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('price');
    }
}
