<?php
namespace infoweb\ecommerce\sales;

use yii\web\AssetBundle as AssetBundle;

class SalesAsset extends AssetBundle
{
    public $sourcePath = '@infoweb/ecommerce/sales/assets/';
    
    public $css = [
        'css/main.css',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'infoweb\cms\CMSAsset',
    ];
}