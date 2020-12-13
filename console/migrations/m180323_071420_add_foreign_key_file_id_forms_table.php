<?php

use yii\db\Migration;

class m180323_071420_add_foreign_key_file_id_forms_table extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('fk-form-image_id', '{{%form}}','image_id','{{%files}}','id','SET NULL','CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-form-image_id', '{{%form}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180323_071420_add_foreign_key_file_id_forms_table cannot be reverted.\n";

        return false;
    }
    */
}
