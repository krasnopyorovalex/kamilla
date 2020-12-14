<?php

use yii\db\Migration;

/**
 * Class m201213_082112_change_price
 */
class m201213_082112_change_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%price_dates_via}}', 'popup', $this->text()->null());
        $this->addColumn('{{%price_settings}}', 'color_five', $this->string(7)->after('color_fourth'));
        $this->addColumn('{{%price_settings}}', 'col_name', $this->string());
        $this->addColumn('{{%price_settings}}', 'col_name_mob', $this->string());
        $this->addColumn('{{%price}}', 'square', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%price_dates_via}}', 'popup');
        $this->dropColumn('{{%price_settings}}', 'color_five');
        $this->dropColumn('{{%price_settings}}', 'col_name');
        $this->dropColumn('{{%price_settings}}', 'col_name_mob');
        $this->dropColumn('{{%price}}', 'square');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201213_082112_change_price cannot be reverted.\n";

        return false;
    }
    */
}
