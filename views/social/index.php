<?php

use yii\helpers\Html;
use kartik\icons\Icon;
use kartik\grid\GridView;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel infoweb\catalogue\models\search\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('infoweb/social', 'Social media');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-index">

    <?php // Title ?>
    <h1>
        <?= Html::encode($this->title) ?>
        <?php // Buttons ?>
        <div class="pull-right">
            <?= Html::a(Yii::t('app', 'Create {modelClass}', [
                'modelClass' => Yii::t('infoweb/social', 'Social media'),
            ]), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </h1>

    <?php // Flash messages ?>
    <?php echo $this->render('_flash_messages'); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',
                'updateOptions' => ['title' => Yii::t('app', 'Update'), 'data-toggle' => 'tooltip'],
                'deleteOptions' => ['title' => Yii::t('app', 'Delete'), 'data-toggle' => 'tooltip'],
                'width' => '100px',
            ],
        ],
        'pjax' => true,
        'pjaxSettings' => [
            'options' => [
                'id' => "grid-pjax",
            ],
        ],
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => 88],
        'export' => false,
        'resizableColumns' => false,
        'hover' => true,
    ]); ?>

</div>
