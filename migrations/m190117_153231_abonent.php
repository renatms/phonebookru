<?php

use yii\db\Migration;

class m190117_153231_abonent extends Migration
{

    public function safeUp()
    {
		$this->createTable('abonent', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(50)->notNull(),
            'second_name' => $this->string(50)->notNull(),
            'middle_name' => $this->string(50)->notNull(),
            'birthday' => $this->date()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->delete('abonent', ['id' => 1]);
        $this->dropTable('abonent');
        return false;
    }
}
