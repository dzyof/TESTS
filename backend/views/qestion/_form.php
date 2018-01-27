<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Qestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qestion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tests_id')->textInput() ?>

    <?= $form->field($model, 'text_qestion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
