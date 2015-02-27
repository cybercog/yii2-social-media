<?php

use yii\helpers\Html;
use kartik\icons\Icon;
use kartik\grid\GridView;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel infoweb\catalogue\models\search\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ecommerce', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <?php // Title ?>
    <h1>
        <?= Html::encode($this->title) ?>
        <?php // Buttons ?>
        <div class="pull-right">
            <?= Html::a(Yii::t('app', 'Create {modelClass}', [
                'modelClass' => Yii::t('ecommerce', 'Customer'),
            ]), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </h1>

    <?php // Flash messages ?>
    <?php echo $this->render('_flash_messages'); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'firstname',
            'company',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete} {active}',
                'buttons' => [
                    'active' => function ($url, $model) {
                        if ($model->active == true) {
                            $icon = 'glyphicon-eye-open';
                        } else {
                            $icon = 'glyphicon-eye-close';
                        }

                        return Html::a('<span class="glyphicon ' . $icon . '"></span>', $url, [
                            'title' => Yii::t('app', 'Toggle active'),
                            'data-pjax' => '0',
                            'data-toggleable' => 'true',
                            'data-toggle-id' => $model->id,
                            'data-toggle' => 'tooltip',
                        ]);
                    }
                ],
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
