<?php

use yii\db\Migration;

class m190117_153446_group extends Migration
{

    public function safeUp()
    {
		$this->createTable('group', [
            'id' => $this->primaryKey(),
            'grypa' => $this->string(20)->notNull(),            
        ]);
		
		$this->batchInsert('group', ['grypa'], [
                                                        ['Домашний'],
                                                        ['Рабочий'],
                                                        ['Сотовый'],
                                                        ['Главный'],                                                        
                                                      ]
                           );
    }

    public function safeDown()
    {
        $this->delete('group', ['id' => 1]);
        $this->delete('group', ['id' => 2]);
        $this->delete('group', ['id' => 3]);
        $this->delete('group', ['id' => 4]);
        $this->dropTable('group');

        return false;
    }
}
