<?php

/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'test';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    if (Yii::$app->user->id == false):
        echo  Yii::$app->session->setFlash('error', 'Для збереження результатів проходження тесту - потрібно залогінитися на сайті');
    endif;
?>
<div class="tests-update">
    <?= $this->render('_form', [
        'modelPerson' => $modelPerson,
        'modelsHouse' => $modelsHouse,
        'modelsRoom' => $modelsRoom,
    ]) ?>
</div>
<button style=" display: none "  type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>
<div  id="myModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            нажаль ви не вклалися в час </br> - спробуйте ще раз

        </div>
    </div>
</div>
