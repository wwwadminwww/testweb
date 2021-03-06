<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m171111_115120_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'keyword' => $this->text(),
            'description' => $this->text(),
            'name' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'slug' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('post');
    }
}
