<?php

use yii\db\Migration;

/**
 * Handles the creation of table `statistic`.
 */
class m180321_083614_create_statistic_table extends Migration
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

        $this->createTable('statistic', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'text' => $this->string()->notNull(),
            'count' => $this->integer()->notNull()->defaultValue(0)
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('statistic');
    }
}
