<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\QestionOption */

$this->title = 'Create Qestion Option';
$this->params['breadcrumbs'][] = ['label' => 'Qestion Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qestion-option-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
