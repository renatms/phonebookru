<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "abonent".
 *
 * @property int $id
 * @property string $first_name
 * @property string $second_name
 * @property string $middle_name
 * @property string $birthday
 *
 * @property Phone[] $phones
 */
class Abonent extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'abonent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'second_name', 'middle_name', 'birthday'], 'required'],
            [['birthday', 'created_at', 'updated_at', 'is_deleted'], 'safe'],
            [['first_name', 'second_name', 'middle_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'second_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'birthday' => 'Дата рождения',
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

    public function search($params)
    {
        $query = Abonent::find()->Where(['is_deleted'=>0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->pagination->pageSize=10;

        // загружаем данные формы поиска
        if (!($this->load($params))) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        //var_dump($this->birthday);die();
        if($this->birthday!=""){
            $this->birthday = Yii::$app->formatter->asDatetime($this->birthday, "php:Y-m-d");
        }
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'birthday', $this->birthday]);

        if($this->birthday!=""){
            $this->birthday = Yii::$app->formatter->asDatetime($this->birthday, "php:d.m.Y");
        }

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['abonent_id' => 'id']);
    }
}
