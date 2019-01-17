<?php

use yii\db\Migration;

/**
 * Class m190117_153446_groups
 */
class m190117_153446_groups extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('groups', [
            'id' => $this->primaryKey(),
            'grypa' => $this->string(20)->notNull(),            
        ]);
		
		$this->batchInsert('groups', ['grypa'], [
                                                        ['Домашний'],
                                                        ['Рабочий'],
                                                        ['Сотовый'],
                                                        ['Главный'],                                                        
                                                      ]
                           );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190117_153446_groups cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190117_153446_groups cannot be reverted.\n";

        return false;
    }
    */
}
