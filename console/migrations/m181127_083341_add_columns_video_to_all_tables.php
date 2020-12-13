<?php

use yii\db\Migration;

/**
 * Class m181127_083341_add_columns_video_to_all_tables
 */
class m181127_083341_add_columns_video_to_all_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%articles}}', 'video', $this->string());
        
        $this->addColumn('{{%news}}', 'video', $this->string());
        
        $this->addColumn('{{%pages}}', 'video', $this->string());
        
        $this->addColumn('{{%rooms}}', 'video', $this->string());
        
        $this->addColumn('{{%specials}}', 'video', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%articles}}', 'video');
        
        $this->dropColumn('{{%news}}', 'video');
        
        $this->dropColumn('{{%pages}}', 'video');
        
        $this->dropColumn('{{%rooms}}', 'video');
        
        $this->dropColumn('{{%specials}}', 'video');
    }
}
