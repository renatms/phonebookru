<?php
/**
 * Created by PhpStorm.
 * User: ecartman
 * Date: 14.02.2019
 * Time: 22:16
 */

namespace app\models;

use yii\db\ActiveQuery;

class AbonentQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function notDeleted()
    {
        return $this
            ->where(['is_deleted'=>0]);
    }
}