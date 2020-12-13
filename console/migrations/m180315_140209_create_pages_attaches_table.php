<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages_attaches`.
 */
class m180315_140209_create_pages_attaches_table extends Migration
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

        $this->createTable('pages_attaches', [
            'page_id' => $this->integer()->notNull(),
            'table_name' => $this->string(32),
            'entity_id' => $this->integer()->notNull()
        ],$tableOptions);

        $this->addForeignKey('fk-pages_attaches-page_id', '{{%pages_attaches}}', 'page_id', '{{%pages}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('pages_attaches');
    }
}
