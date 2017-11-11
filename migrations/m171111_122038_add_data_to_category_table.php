<?php

use yii\db\Migration;

/**
 * Class m171111_122038_add_data_to_category_table
 */
class m171111_122038_add_data_to_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert('category',['name','description','slug','type'],
            [
                ['Головне','Головні події України та світу','main_events',1],
                ['Політика','Політичні новини України та світу','political_news',2],
                ['Економіка','Економіка та бізнес','economy_news',1],
                ['Події','Оперативно про надзвичайні події','events',2],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->truncateTable('category');
//        echo "m171111_122038_add_data_to_category_table cannot be reverted.\n";
//
//        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171111_122038_add_data_to_category_table cannot be reverted.\n";

        return false;
    }
    */
}
