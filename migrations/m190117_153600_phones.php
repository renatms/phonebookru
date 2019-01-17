<?php

use yii\db\Migration;

/**
 * Class m190117_153600_phones
 */
class m190117_153600_phones extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		 $this->createTable('phones', [
            'id' => $this->primaryKey(),
            'abonent_id' => $this->Integer(8)->notNull(),
            'group_id' => $this->Integer(8)->notNull(),
            'number' => $this->string(20)->notNull(),
        ]);    
		 $this->addForeignKey('abonent_id', 'phones', 'abonent_id',
                                            'abonent', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('group_id', 'phones', 'group_id',
                                            'groups', 'id', 'CASCADE', 'CASCADE');														
		

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190117_153600_phones cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190117_153600_phones cannot be reverted.\n";

        return false;
    }
    */
}
