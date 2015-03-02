<?php
namespace infoweb\social\assets;

use yii\web\AssetBundle as AssetBundle;

class SocialAsset extends AssetBundle
{
    public $sourcePath = '@infoweb/social/assets/';
    
    public $css = [
        'css/main.css',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'infoweb\cms\CMSAsset',
    ];
}