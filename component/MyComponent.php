<?php


namespace app\component;


class MyComponent extends \yii\base\Component
{
    static function dd($value)
    {
        print_r("<pre>");
        print_r($value);
        print_r("</pre>");
    }

}