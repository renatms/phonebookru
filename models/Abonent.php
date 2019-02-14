<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "abonent".
 *
 * @property int $id
 * @property string $first_name
 * @property string $second_name
 * @property string $middle_name
 * @property string $birthday
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 *
 * @property Phone[] $phones
 */
class Abonent extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abonent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'second_name', 'middle_name', 'birthday'], 'required'],
            [['first_name', 'second_name', 'middle_name'], 'string', 'max' => 50],
            [['birthday'], 'date','format'=>'php:d.m.Y'],
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
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'is_deleted' => 'Удален',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['abonent_id' => 'id']);
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
                'value' => function () {
                    $date = new \yii\db\Expression('NOW()');
                    return $date;
                }
            ],
        ];
    }

    /**
     *
     */
    public function afterFind()
    {
        $this->birthday = Yii::$app->formatter->asDate($this->birthday, "php:d.m.Y");
        parent::afterFind();
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
                $this->birthday = Yii::$app->formatter->asDate($this->birthday, "php:Y-m-d");
            } else {
                Yii::$app->session->setFlash('success', 'Запись обновлена!');
                $this->birthday = Yii::$app->formatter->asDate($this->birthday, "php:Y-m-d");
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        $this->birthday=Yii::$app->formatter->asDate($this->birthday, "php:Y-m-d");
        return parent::beforeDelete();
    }

    /**
     * @return AbonentQuery
     */
    public static function find()
    {
        return new AbonentQuery(get_called_class());
    }
}
