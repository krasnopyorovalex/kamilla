<?php

use yii\db\Migration;

class m180429_073255_add_column_color_to_carousel_images_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('carousel_images', 'color', $this->string('7')->after('carousel_id'));
    }

    public function safeDown()
    {
        $this->dropColumn('carousel_images', 'color');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180429_073255_add_column_color_to_carousel_images_table cannot be reverted.\n";

        return false;
    }
    */
}
