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
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'user_id' => $this->integer(11)->notNull(),
        ]);

        $this->addForeignKey('user_id', 'abonent', 'user_id',
            'user', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('abonent');
    }
}
