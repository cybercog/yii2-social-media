<?php

use yii\helpers\Html;


$this->title = Yii::t('infoweb/social', 'Update {modelClass}', [
    'modelClass' => Yii::t('infoweb/social', 'Social media'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ecommerce', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('infoweb/social', 'Update');
?>
<div class="social-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
    ]) ?>

</div>
