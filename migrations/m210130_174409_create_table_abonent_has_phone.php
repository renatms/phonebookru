<?php

use yii\db\Migration;

/**
 * Class m210130_174409_create_table_contact_has_phone
 */
class m210130_174409_create_table_contact_has_phone extends Migration
{
    const TABLE_NAME = '{{%contact_has_phone}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME,
        [
            'contact_id' => $this->integer()->notNull(),
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
