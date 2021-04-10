<?php

namespace app\services;

use app\models\Phone;


class PhoneService
{
    public function savePhone($model, $phones)
    {
        foreach ($phones as $phonePost) {
            if (!empty($phonePost['number'])) {

                $phone = new Phone();
                $phone->abonent_id = $model->id;
                $phone->number = $phonePost['number'];
                $phone->group_id = $phonePost['group_id'];
                $phone->save();
            }
        }
    }

}