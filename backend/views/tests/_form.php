<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tests */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_tests')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_passing')->textInput() ?>

<!--    --><?//= $form->field($model, 'number_passing')->textInput()?>

<!--    --><?//= $form->field($model, 'avarage_score')->textInput()?>

<!--    --><?//= $form->field($model, 'created_at')->textInput()?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
