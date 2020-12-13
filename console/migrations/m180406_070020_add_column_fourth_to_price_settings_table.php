<?php

use yii\db\Migration;

class m180406_070020_add_column_fourth_to_price_settings_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('price_settings', 'color_fourth', $this->string(7)->after('color_third'));
    }

    public function safeDown()
    {
        $this->dropColumn('price_settings', 'color_fourth');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180406_070020_add_column_fourth_to_price_settings_table cannot be reverted.\n";

        return false;
    }
    */
}
