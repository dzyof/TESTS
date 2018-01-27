<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\QestionOption */

$this->title = 'Update Qestion Option: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Qestion Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qestion-option-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
