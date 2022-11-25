<?php

use yii\db\Migration;

class m190117_153446_group extends Migration
{
    const TABLE = 'group';

    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'type' => $this->string(20)->notNull(),
        ]);

        $this->batchInsert(self::TABLE, ['type'], [
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
