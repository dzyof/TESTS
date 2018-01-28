<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Qestion */

$this->title = 'Create Qestion';
$this->params['breadcrumbs'][] = ['label' => 'Qestions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qestion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
