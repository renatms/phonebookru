<?php

use yii\db\Migration;

class m190117_153446_group extends Migration
{

    public function safeUp()
    {
		$this->createTable('group', [
            'id' => $this->primaryKey(),
            'type' => $this->string(20)->notNull(),
        ]);
		
		$this->batchInsert('group', ['type'], [
                                                        ['Домашний'],
                                                        ['Рабочий'],
                                                        ['Сотовый'],
                                                        ['Главный'],                                                        
                                                      ]
                           );
    }

    public function safeDown()
    {
        $this->dropTable('group');
    }
}
