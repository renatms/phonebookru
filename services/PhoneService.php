<?php

namespace app\services;

use app\models\Phone;
use yii\base\Model;
use yii\helpers\ArrayHelper;


class PhoneService
{
    public function savePhone($abonentId, $phones, $prePones = [])
    {
        $oldPhones = ArrayHelper::toArray($prePones);

        Model::loadMultiple($prePones, $phones, 'Phone');

        $phones['NewPhone'] = $phones['NewPhone'] ?? [];

        foreach ($prePones as $key => $ph) {
            if ($oldPhones[$key]['number'] != $ph->number || $oldPhones[$key]['group_id'] != $ph->group_id) {
                $ph->save();
            }
        }

        foreach ($phones['NewPhone'] as $newPhone) {
            if (!empty($newPhone['number'])) {

                $phone = new Phone();
                $phone->abonent_id = $abonentId;
                $phone->number = $newPhone['number'];
                $phone->group_id = $newPhone['group_id'];
                $phone->save();
            }
        }
    }

}