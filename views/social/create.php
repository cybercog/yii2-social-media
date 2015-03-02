<?php

use yii\helpers\Html;

$this->title = Yii::t('infoweb/social', 'Create {modelClass}', [
    'modelClass' => Yii::t('infoweb/social', 'social media'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('infoweb/social', 'Social media'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
    ]) ?>

</div>
