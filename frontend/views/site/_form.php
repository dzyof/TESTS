<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<div class="person-form">


    Залишилося  часу <span class="seconds"> <?= $modelPerson->time_passing * 60 ?></span>с.
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>


    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($modelPerson, 'name_tests')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelPerson, 'time_passing')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $modelsHouse[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'text_qestion',
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Питання</th>
            <th style="width: 450px;">Варіанти відповіді</th>
        </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsHouse as $indexHouse => $modelHouse): ?>
            <tr class="house-item">
                <td class="vcenter">
                    <?php
                    // necessary for update action.
                    if (! $modelHouse->isNewRecord) {
                        echo Html::activeHiddenInput($modelHouse, "[{$indexHouse}]id");
                    }
                    ?>
                    <?= $form->field($modelHouse, "[{$indexHouse}]text_qestion")->label(false)->textInput(['maxlength' => true]) ?>
                </td>
                <td>
                    <?= $this->render('_form-rooms', [
                        'form' => $form,
                        'indexHouse' => $indexHouse,
                        'modelsRoom' => $modelsRoom[$indexHouse],
                    ]) ?>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton('Все вірно - відправити відповіді ', ['class' => 'btn btn-primary','id' => 'autoSend']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>