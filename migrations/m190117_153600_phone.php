<?php

use yii\db\Migration;

class m190117_153600_phone extends Migration
{
    public function safeUp()
    {
		 $this->createTable('phone', [
            'id' => $this->primaryKey(),
            'abonent_id' => $this->integer(8)->notNull(),
            'group_id' => $this->integer(8)->notNull(),
            'number' => $this->string(20)->notNull(),
             'created_at' => $this->timestamp(),
             'updated_at' => $this->timestamp(),
             'is_deleted' => $this->boolean()->defaultValue(0)
        ]);    
		 $this->addForeignKey('abonent_id', 'phone', 'abonent_id',
                                            'abonent', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('group_id', 'phone', 'group_id',
                                            'group', 'id', 'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
        $this->dropTable('phone');
    }
}
