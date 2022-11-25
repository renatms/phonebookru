<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $first_name
 * @property string $second_name
 * @property string $middle_name
 * @property string $birthday
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 * @property int $user_id
 *
 * @property Phone[] $phones
 */
class Contact extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'second_name', 'middle_name', 'birthday'], 'required'],
            [['first_name', 'second_name', 'middle_name'], 'string', 'max' => 50],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['formattedBirthday'], 'date', 'format' => 'php:d.m.Y'],
            [['user_id'], 'default', 'value' => user()->getId()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'first_name' => 'Имя',
            'second_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'birthday' => 'День рождениe',
            'formattedBirthday' => 'День рождениe',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'is_deleted' => 'Удален',
            'user_id' => 'User_id'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['contact_id' => 'id']);
    }

    /**
     * @return array
     */
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
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function () {
                    return new \yii\db\Expression('NOW()');
                }
            ]
        ];
    }

    /**
     * @return false|string
     */
    public function getFormattedBirthday()
    {
        if (!empty($this->birthday)) {
            return date('d.m.Y', strtotime($this->birthday));
        }
        return false;
    }

    /**
     * @param $date
     */
    public function setFormattedBirthday($date)
    {
        if (empty($date)) {
            $this->birthday = null;
        } else {
            $this->birthday = date('Y-m-d', strtotime($date));
        }
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Запись добавлена!');
            } else {
                Yii::$app->session->setFlash('success', 'Запись обновлена!');
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return ContactQuery
     */
    public static function find()
    {
        return new ContactQuery(get_called_class());
    }
}
