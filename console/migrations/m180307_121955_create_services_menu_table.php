<?php

use yii\db\Migration;

/**
 * Handles the creation of table `table_services_menu`.
 */
class m180307_121955_create_services_menu_table extends Migration
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

        $this->createTable('services_menu', [
            'id' => $this->primaryKey(),
            'sys_name' => $this->string(32)->notNull(),
            'name' => $this->string(512)->notNull()
        ],$tableOptions);

        $this->createTable('services_menu_categories', [
            'id' => $this->primaryKey(),
            'services_menu_id' => $this->integer()->notNull(),
            'name' => $this->string(512)->notNull(),
            'slogan' => $this->string()
        ],$tableOptions);

        $this->createTable('services_menu_categories_items', [
            'id' => $this->primaryKey(),
            'services_menu_category_id' => $this->integer()->notNull(),
            'name' => $this->string(512)->notNull(),
            'image_id' => $this->integer(),
            'text' => $this->text(),
            'price' => $this->text()
        ],$tableOptions);

        $this->addForeignKey(
            'fk-services_menu_categories_items-image_id',
            '{{%services_menu_categories_items}}',
            'image_id',
            '{{%files}}',
            'id','SET NULL','CASCADE'
        );

        $this->addForeignKey(
            'fk-services_menu_categories-services_menu_id',
            '{{%services_menu_categories}}',
            'services_menu_id',
            '{{%services_menu}}',
            'id'
        );
        $this->addForeignKey(
            'fk-services_menu_categories_items-services_menu_category_id',
            '{{%services_menu_categories_items}}',
            'services_menu_category_id',
            '{{%services_menu_categories}}',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('services_menu');
    }
}
