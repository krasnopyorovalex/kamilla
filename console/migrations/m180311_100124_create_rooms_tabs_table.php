<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rooms_tabs`.
 */
class m180311_100124_create_rooms_tabs_table extends Migration
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

        $this->createTable('{{%rooms_tabs}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ],$tableOptions);

        $this->createTable('{{%rooms_tabs_via}}', [
            'room_id' => $this->integer()->notNull(),
            'tab_id' => $this->integer()->notNull(),
            'value' => $this->text(),
        ],$tableOptions);

        $this->addPrimaryKey('pk-rooms_tabs_via', '{{%rooms_tabs_via}}', ['room_id', 'tab_id']);

        $this->createIndex('idx-rooms_tabs_via-room_id', '{{%rooms_tabs_via}}', 'room_id');
        $this->createIndex('idx-rooms_tabs_via-tab_id', '{{%rooms_tabs_via}}', 'tab_id');

        $this->addForeignKey('fk-rooms_tabs_via-room', '{{%rooms_tabs_via}}', 'room_id', '{{%rooms}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-rooms_tabs_via-tab', '{{%rooms_tabs_via}}', 'tab_id', '{{%rooms_tabs}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('rooms_tabs');
        $this->dropTable('rooms_tabs_via');
    }
}
