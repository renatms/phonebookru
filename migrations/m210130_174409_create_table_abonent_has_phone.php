<?php

use yii\db\Migration;

/**
 * Class m210130_174409_create_table_abonent_has_phone
 */
class m210130_174409_create_table_abonent_has_phone extends Migration
{
    const TABLE_NAME = '{{%abonent_has_phone}}';
    const ABONENT = 'abonent';
    const PHONE = 'phone';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME,
        [
            'abonent_id' => $this->integer()->notNull(),
            'phone_id' => $this->integer()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

}
