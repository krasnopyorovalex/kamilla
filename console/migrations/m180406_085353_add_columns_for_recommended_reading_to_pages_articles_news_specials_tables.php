<?php

use yii\db\Migration;

class m180406_085353_add_columns_for_recommended_reading_to_pages_articles_news_specials_tables extends Migration
{
    public function safeUp()
    {
        //for pages
        $this->addColumn('pages', 'name_rr', $this->string()->after('image_id'));
        $this->addColumn('pages', 'text_rr', $this->text()->after('name_rr'));
        $this->addColumn('pages', 'image_rr_id', $this->integer()->after('name_rr'));

        $this->addForeignKey('fk-pages-image_rr_id', '{{%pages}}','image_rr_id','{{%files}}','id','SET NULL','CASCADE');

        //for news
        $this->addColumn('news', 'name_rr', $this->string()->after('image_header_id'));
        $this->addColumn('news', 'text_rr', $this->text()->after('name_rr'));
        $this->addColumn('news', 'image_rr_id', $this->integer()->after('name_rr'));

        $this->addForeignKey('fk-news-image_rr_id', '{{%news}}','image_rr_id','{{%files}}','id','SET NULL','CASCADE');

        //for articles
        $this->addColumn('articles', 'name_rr', $this->string()->after('image_header_id'));
        $this->addColumn('articles', 'text_rr', $this->text()->after('name_rr'));
        $this->addColumn('articles', 'image_rr_id', $this->integer()->after('name_rr'));

        $this->addForeignKey('fk-articles-image_rr_id', '{{%articles}}','image_rr_id','{{%files}}','id','SET NULL','CASCADE');

        //for specials
        $this->addColumn('specials', 'name_rr', $this->string()->after('image_header_id'));
        $this->addColumn('specials', 'text_rr', $this->text()->after('name_rr'));
        $this->addColumn('specials', 'image_rr_id', $this->integer()->after('name_rr'));

        $this->addForeignKey('fk-specials-image_rr_id', '{{%specials}}','image_rr_id','{{%files}}','id','SET NULL','CASCADE');
    }

    public function safeDown()
    {
        $this->dropColumn('pages', 'name_rr');
        $this->dropColumn('pages', 'text_rr');
        $this->dropColumn('pages', 'image_rr_id');

        $this->dropColumn('news', 'name_rr');
        $this->dropColumn('news', 'text_rr');
        $this->dropColumn('news', 'image_rr_id');

        $this->dropColumn('articles', 'name_rr');
        $this->dropColumn('articles', 'text_rr');
        $this->dropColumn('articles', 'image_rr_id');

        $this->dropColumn('specials', 'name_rr');
        $this->dropColumn('specials', 'text_rr');
        $this->dropColumn('specials', 'image_rr_id');
    }
}
