<?php

use yii\db\Migration;

class m160513_123842_seo_blocks extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%seo_blocks}}', [
            'id' => $this->primaryKey(),
            'sys_name' => $this->string(128)->notNull(),
            'value' => $this->text(),
            'show_in_pages' => $this->text(),
            'for_frontend' => $this->smallInteger(1)->notNull()->defaultValue(1)
        ],$tableOptions);


        $this->insert('{{%seo_blocks}}',['sys_name' => 'favicon','value' => '','for_frontend' => 1]);
        $this->insert('{{%seo_blocks}}',['sys_name' => 'chat','value' => '','for_frontend' => 1]);
        $this->insert('{{%seo_blocks}}',['sys_name' => 'share_in_social_networks','value' => '','for_frontend' => 1]);
        $this->insert('{{%seo_blocks}}',['sys_name' => 'we_in_social_networks','value' => '','for_frontend' => 1]);
        $this->insert('{{%seo_blocks}}',['sys_name' => 'widget_social_networking','value' => '','for_frontend' => 1]);
        $this->insert('{{%seo_blocks}}',['sys_name' => 'metric','value' => '','for_frontend' => 1]);
        $this->insert('{{%seo_blocks}}',['sys_name' => 'count_mail','value' => '','for_frontend' => 1]);
        $this->insert('{{%seo_blocks}}',['sys_name' => 'yandex_verification','value' => '','for_frontend' => 0]);
        $this->insert('{{%seo_blocks}}',['sys_name' => 'google_verification','value' => '','for_frontend' => 0]);
    }

    public function down()
    {
        $this->dropTable('{{%seo_blocks}}');
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
