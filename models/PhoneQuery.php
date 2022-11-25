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
     * @return $this
     */
    public function notDeleted()
    {
        return $this
            ->andWhere(['is_deleted' => false]);
    }

    /**
     * @param $id
     * @return $this
     */
    public function forContact($id)
    {
        return $this
            ->andWhere(['contact_id' => $id]);
    }
}