<?php

use yii\db\Migration;

class m190117_153600_phone extends Migration
{
    const TABLE = 'phone';
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'contact_id' => $this->integer(8)->notNull(),
            'group_id' => $this->integer(8)->notNull(),
            'number' => $this->string(20)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'is_deleted' => $this->boolean()->defaultValue(0)
        ]);
        $this->addForeignKey('fk_phone', 'phone', 'contact_id',
            'contact', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_group', 'phone', 'group_id',
            'group', 'id', 'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_group', 'phone');
        $this->dropForeignKey('fk_phone', 'phone');
        $this->dropTable(self::TABLE);
    }
}
