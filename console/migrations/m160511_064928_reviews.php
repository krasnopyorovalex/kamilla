<?php

use yii\db\Migration;

class m160511_064928_reviews extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'ip' => $this->string(15)->notNull(),
            'name' => $this->string(128),
            'email' => $this->string(64),
            'city' => $this->string(128),
            'text' =>$this->text()->notNull(),
            'answer' =>$this->text(),
            'publish' => $this->smallInteger(1)->defaultValue(0),
            'show_in_main' => $this->smallInteger(1)->defaultValue(0)
        ],$tableOptions);

        $this->createTable('{{%reviews_images}}', [
            'id' => $this->primaryKey(),
            'review_id' => $this->integer()->notNull(),
            'alt' => $this->string(),
            'title' => $this->string(),
            'basename' => $this->string(256)->notNull(),
            'ext' => $this->string(5)->notNull(),
            'pos' => $this->integer()->notNull()->defaultValue(0)
        ], $tableOptions);

        $this->createIndex('idx-reviews-publish', '{{%reviews}}', 'publish');
        $this->createIndex('idx-reviews_images-review_id', '{{%reviews_images}}', 'review_id');
        
        $this->addForeignKey('fk-reviews_images-review_id', '{{%reviews_images}}','review_id','{{%reviews}}','id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%reviews}}');
        $this->dropTable('{{%reviews_images}}');
    }
}
