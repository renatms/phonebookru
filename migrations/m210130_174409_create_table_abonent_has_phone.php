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

        $this->addForeignKey('fk_abonent_id', self::TABLE_NAME, 'abonent_id',
            self::ABONENT, 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('fk_phone_id', self::TABLE_NAME, 'phone_id',
            self::PHONE, 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_abonent_id', self::TABLE_NAME);
        $this->dropForeignKey('fk_phone_id', self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }

}
