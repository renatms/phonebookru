<?php

function app()
{
    return Yii::$app;
}

function print_pre($arg)
{
    print '<pre>';
    print_r($arg);
    print '</pre>';
}

function post($name = null, $defaultValue = null)
{
    return app()->request->post($name, $defaultValue);
}

function get($name = null, $defaultValue = null)
{
    return app()->request->get($name, $defaultValue);
}

function user(): ?\yii\web\IdentityInterface
{
    return app()->getUser()->identity;
}