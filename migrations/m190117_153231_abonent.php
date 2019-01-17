<?php

use yii\db\Migration;

/**
 * Class m190117_153231_abonent
 */
class m190117_153231_abonent extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('abonent', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'sname' => $this->string(50)->notNull(),
            'oname' => $this->string(50)->notNull(),
            'birth' => $this->string(20)->notNull(),            
        ]);
        //$this->alterColumn('abonent','id', $this->smallInteger(8).' NOT NULL AUTO_INCREMENT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190117_153231_abonent cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190117_153231_abonent cannot be reverted.\n";

        return false;
    }
    */
}
