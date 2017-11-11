<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m171111_115010_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'slug' => $this->string()->notNull(),
            'type' => $this->smallInteger(2)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
