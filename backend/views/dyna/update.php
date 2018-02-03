<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Qestion */

$this->title = 'Update Qestion: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Qestions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qestion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [

        'model' => $model,
        'modelPerson' => $modelPerson,
        'modelsHouse' => $modelsHouse,
        'modelsRoom' => $modelsRoom,
    ]) ?>

</div>
