<?php
use kartik\widgets\SwitchInput;
use kartik\widgets\Select2;
?>
<div class="tab-content default-tab">
    
    <?= $form->field($model, 'group_id')->widget(Select2::classname(), [
        'data' => $groups,
        'options' => ['placeholder' => Yii::t('ecommerce', 'Select a group')],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]); ?>
    
    <?= $form->field($model, 'company')->textInput(['maxlength' => 255]) ?>
    
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>    
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>    
        </div>
    </div>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'zipcode')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-sm-9">
            <?= $form->field($model, 'city')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>
    
    <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
        'data' => [21 => 'Belgie'],
        'options' => ['placeholder' => Yii::t('ecommerce', 'Select a country')],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
    
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>    
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => 255]) ?>    
        </div>
    </div>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => 255]) ?>
    
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>
    
    <?php echo $form->field($model, 'active')->widget(SwitchInput::classname(), [
        'inlineLabel' => false,
        'pluginOptions' => [
            'onColor' => 'success',
            'offColor' => 'danger',
            'onText' => Yii::t('app', 'Yes'),
            'offText' => Yii::t('app', 'No'),
        ]
    ]); ?>
</div>