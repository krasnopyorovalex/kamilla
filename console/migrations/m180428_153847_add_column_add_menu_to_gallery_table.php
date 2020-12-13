<?php

use yii\db\Migration;

class m180428_153847_add_column_add_menu_to_gallery_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('gallery', 'add_menu', $this->smallInteger(1)->after('sys_name')->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn('gallery', 'add_menu');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180428_153847_add_column_add_menu_to_gallery_table cannot be reverted.\n";

        return false;
    }
    */
}
