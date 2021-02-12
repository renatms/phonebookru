<?php
/**
 * Created by PhpStorm.
 * User: ecartman
 * Date: 14.02.2019
 * Time: 22:16
 */

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

class AbonentQuery extends ActiveQuery
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
     * @return $this
     */
    public function forAuthorized()
    {
        $getId = user()->getId();
        if (empty($getId)) {
            $getId = 0;
        }

        return $this
            ->andWhere(['user_id' => $getId]);
    }
}