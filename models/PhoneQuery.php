<?php
/**
 * Created by PhpStorm.
 * User: ecartman
 * Date: 14.02.2019
 * Time: 22:50
 */

namespace app\models;

use yii\db\ActiveQuery;


class PhoneQuery extends ActiveQuery
{
    /**
     * @param $id
     * @return $this
     */
    public function notDeleted($id)
    {
        return $this
            ->andWhere(['abonent_id'=>$id])
            ->andWhere(['is_deleted'=>0]);
    }
}