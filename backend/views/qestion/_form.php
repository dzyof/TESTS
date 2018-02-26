<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Test;

/* @var $this yii\web\View */
/* @var $model backend\models\Qestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qestion-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'tests_id')->dropDownList(
           ArrayHelper::map(Test::find()->all(), 'id', 'name_tests'),
           ['prompt' =>'Select Test' ]
    ) ?>

    <?= $form->field($model, 'text_qestion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
