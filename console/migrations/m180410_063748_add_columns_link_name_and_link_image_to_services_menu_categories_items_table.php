<?php

use yii\db\Migration;

class m180410_063748_add_columns_link_name_and_link_image_to_services_menu_categories_items_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('services_menu_categories_items', 'name_link', $this->string()->after('name'));
        $this->addColumn('services_menu_categories_items', 'image_link', $this->string()->after('image_id'));
    }

    public function safeDown()
    {
        $this->dropColumn('services_menu_categories_items', 'name_link');
        $this->dropColumn('services_menu_categories_items', 'image_link');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180410_063748_add_columns_link_name_and_link_image_to_services_menu_categories_items_table cannot be reverted.\n";

        return false;
    }
    */
}
