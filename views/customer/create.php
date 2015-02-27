<?php

use yii\helpers\Html;

$this->title = Yii::t('ecommerce', 'Create {modelClass}', [
    'modelClass' => Yii::t('ecommerce', 'Customer'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ecommerce', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
        'groups'    => $groups
    ]) ?>

</div>
