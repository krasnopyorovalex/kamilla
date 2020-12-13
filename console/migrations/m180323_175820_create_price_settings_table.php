<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price_settings`.
 */
class m180323_175820_create_price_settings_table extends Migration
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

        $this->createTable('price_settings', [
            'id' => $this->primaryKey(),
            'color_head_btn' => $this->string(7),
            'color_first' => $this->string(7),
            'color_second' => $this->string(7),
            'color_third' => $this->string(7),
            'color_border' => $this->string(7)
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('price_settings');
    }
}
