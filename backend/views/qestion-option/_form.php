<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\QestionOption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qestion-option-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'qestion_id')->textInput() ?>

    <?= $form->field($model, 'option_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correct_option')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
