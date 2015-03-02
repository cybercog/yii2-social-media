<?php

namespace infoweb\social;

use Yii;

class Module extends \yii\base\Module
{

    public function init()
    {
        parent::init();

        Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}