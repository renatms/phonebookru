<?php

namespace app\models;

use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "phone".
 *
 * @property int $id
 * @property int $abonent_id
 * @property int $group_id
 * @property string $number
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 *
 * @property Abonent $abonent
 * @property Group $group
 */
class Phone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['abonent_id', 'group_id'], 'integer'],
            [['number'], 'string', 'max' => 20],
            [['abonent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Abonent::className(), 'targetAttribute' => ['abonent_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'abonent_id' => 'Abonent ID',
            'group_id' => 'Тип номера',
            'number' => 'Номер телефона',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
                'replaceRegularDelete' => true // mutate native `delete()` method
            ],
            [
                'class' => 'yii\behaviors\TimestampBehavior',
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

    /**
     * @return PhoneQuery
     */
    public static function find()
    {
        return new PhoneQuery(get_called_class());
    }
}
