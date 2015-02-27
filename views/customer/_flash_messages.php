<?php if (Yii::$app->getSession()->hasFlash('customer')): ?>
<div class="alert alert-success">
    <p><?= Yii::$app->getSession()->getFlash('customer') ?></p>
</div>
<?php endif; ?>

<?php if (Yii::$app->getSession()->hasFlash('customer-error')): ?>
<div class="alert alert-danger">
    <p><?= Yii::$app->getSession()->getFlash('customer-error') ?></p>
</div>
<?php endif; ?>