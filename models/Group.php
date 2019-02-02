<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $grypa
 *
 * @property Phone[] $phones
 */
class Group extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'group';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grypa' => 'Тип номера',
        ];
    }

    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['group_id' => 'id']);
    }
}
