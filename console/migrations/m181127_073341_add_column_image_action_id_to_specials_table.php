<?php

use yii\db\Migration;

/**
 * Class m181127_073341_add_column_image_action_id_to_specials_table
 */
class m181127_073341_add_column_image_action_id_to_specials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%specials}}', 'image_action_id', $this->integer()->after('image_header_id'));

        $this->addForeignKey('fk-specials-image_action_id', '{{%specials}}','image_action_id','{{%files}}','id','SET NULL','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-specials-image_action_id', '{{%specials}}');

        $this->dropColumn('{{%specials}}', 'image_action_id');
    }
}
