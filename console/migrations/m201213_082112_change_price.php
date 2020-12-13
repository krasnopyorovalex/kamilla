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

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201213_082112_change_price cannot be reverted.\n";

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
