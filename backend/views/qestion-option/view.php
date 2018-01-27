<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\QestionOption */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qestion Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qestion-option-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'qestion_id',
            'option_text',
            'correct_option',
        ],
    ]) ?>

</div>
