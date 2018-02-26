<?php

use backend\models\Question;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionOption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qestion-option-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'qestion_id')->dropDownList(
        ArrayHelper::map(Question::find()->all(), 'id', 'text_qestion'),
        ['prompt' =>'Виберіть до якого питання' ]
    ) ?>

    <?= $form->field($model, 'option_text')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'correct_option')->dropDownList(
        [ 0 => 'Не Вірно',
          1 => 'Вірно' ]
    ) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
