<?php


namespace app\component;


use yii\web\Controller;

class MyComponent extends Controller
{
    static function dd($value)
    {
        print_r("<pre>");
        print_r($value);
        print_r("</pre>");
    }

}