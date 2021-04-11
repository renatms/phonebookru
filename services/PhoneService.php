<?php

namespace app\services;

use app\models\Phone;


class PhoneService
{
    public function savePhone($abonentId, $phones, $prePones = [])
    {
        $phones['NewPhone'] = $phones['NewPhone'] ?? [];

        foreach ($prePones as $ph) {
            $ph->save();
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