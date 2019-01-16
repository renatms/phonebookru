<?php  

namespace app\models;

use yii\db\ActiveRecord;

class Phones extends ActiveRecord
{
	public function rules()
	{
		return [
			[['abonent_id', 'group_id', 'number'], 'safe'],									
		];
	}
}