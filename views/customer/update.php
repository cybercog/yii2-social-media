<?php

use yii\helpers\Html;


$this->title = Yii::t('ecommerce', 'Update {modelClass}', [
    'modelClass' => Yii::t('ecommerce', 'Customer'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ecommerce', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ecommerce', 'Update');
?>
<div class="customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
        'groups'    => $groups
    ]) ?>

</div>
