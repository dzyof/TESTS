<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionOption */

$this->title = 'Create Question Option';
$this->params['breadcrumbs'][] = ['label' => 'Question Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qestion-option-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
