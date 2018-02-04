<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Qestion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qestions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qestion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
//        'modelPerson' => $modelPerson,
//        'modelsHouse' => $modelsHouse,
//        'modelsRoom' => $modelsRoom,
        'attributes' => [
            'id',
            'last_name',
            'first_name',
//            'tests_id',
//            'text_qestion',
        ],
    ]) ?>





</div>