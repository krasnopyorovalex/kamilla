<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price_dates`.
 */
class m170920_064035_create_price_dates_table extends Migration
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
        $this->createTable('{{%price_dates}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ],$tableOptions);

        $this->createTable('{{%price_dates_via}}', [
            'price_id' => $this->integer(),
            'price_dates_id' => $this->integer(),
            'value' => $this->text()->notNull(),
        ],$tableOptions);

        $this->addPrimaryKey('pk-price_dates_via', '{{%price_dates_via}}', ['price_id', 'price_dates_id']);

        $this->createIndex('idx-price_dates_via-price_id', '{{%price_dates_via}}', 'price_id');
        $this->createIndex('idx-price_dates_via-price_dates_id', '{{%price_dates_via}}', 'price_dates_id');

        $this->addForeignKey('fk-price_dates_via-price', '{{%price_dates_via}}', 'price_id', '{{%price}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-price_dates_via-price_dates', '{{%price_dates_via}}', 'price_dates_id', '{{%price_dates}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%price_dates_via}}');
        $this->dropTable('{{%price_dates}}');
    }
}
