<?php

use yii\db\Migration;

class m160516_132019_settings extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'sys_name' => $this->string(128)->notNull(),
            'value' => $this->text(),
        ],$tableOptions);


        $this->insert('{{%settings}}',['sys_name' => 'site_status','value' => 1]);
        $this->insert('{{%settings}}',['sys_name' => 'text_off','value' => '']);
        $this->insert('{{%settings}}',['sys_name' => 'g_public_key','value' => '']);
        $this->insert('{{%settings}}',['sys_name' => 'g_private_key','value' => '']);
        $this->insert('{{%settings}}',['sys_name' => 'robots','value' => '']);
        $this->insert('{{%settings}}',['sys_name' => 'bg_color_top_line','value' => '#1f232b']);
        $this->insert('{{%settings}}',['sys_name' => 'bg_color_menu','value' => '#344a71']);
        $this->insert('{{%settings}}',['sys_name' => 'show_slider','value' => 1]);
        $this->insert('{{%settings}}',['sys_name' => 'recommended_reading_view','value' => 'v1']);
        $this->insert('{{%settings}}',['sys_name' => 'recommended_reading_title','value' => 'Рекомендуем к прочтению']);
        $this->insert('{{%settings}}',['sys_name' => 'statistic_title','value' => 'Статистика']);
        $this->insert('{{%settings}}',['sys_name' => 'catalog_alias','value' => 'rooms']);
        $this->insert('{{%settings}}',['sys_name' => 'head_bg_if_not_img','value' => '']);
        $this->insert('{{%settings}}',['sys_name' => 'view_booking_block','value' => 0]);
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');
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
