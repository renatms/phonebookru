<?php  

namespace app\models;

use yii\db\ActiveRecord;

class Abonent extends ActiveRecord
{
	public function rules()
	{
		return [
			[['name', 'sname', 'oname', 'birth'], 'safe'],
            [ ['name', 'sname', 'oname', 'birth'], 'required'],
		];
	}

	public function attributeLabels()
	{
		return [
			'name' => 'Имя',
			'sname' => 'Фамилия',
			'oname' => 'Отчество',
			'birth' => 'Дата рождения',
		];
	}
}


