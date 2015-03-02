<?php if (Yii::$app->getSession()->hasFlash('social')): ?>
<div class="alert alert-success">
    <p><?= Yii::$app->getSession()->getFlash('social') ?></p>
</div>
<?php endif; ?>

<?php if (Yii::$app->getSession()->hasFlash('social-error')): ?>
<div class="alert alert-danger">
    <p><?= Yii::$app->getSession()->getFlash('social-error') ?></p>
</div>
<?php endif; ?>