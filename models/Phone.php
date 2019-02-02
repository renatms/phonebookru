<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "phone".
 *
 * @property int $id
 * @property int $abonent_id
 * @property int $group_id
 * @property string $number
 *
 * @property Abonent $abonent
 * @property Group $group
 */
class Phone extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['abonent_id', 'group_id'], 'required'],
            [['abonent_id', 'group_id'], 'integer'],
            [['created_at', 'updated_at', 'is_deleted'], 'safe'],
            [['number'], 'string', 'max' => 20],
            [['abonent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Abonent::className(), 'targetAttribute' => ['abonent_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'abonent_id' => 'Abonent ID',
            'group_id' => 'Тип номера',
            'number' => 'Номер телефона',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен'
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    $date = new \yii\db\Expression('NOW()');
                    return $date;
                }
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbonent()
    {
        return $this->hasOne(Abonent::className(), ['id' => 'abonent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}
