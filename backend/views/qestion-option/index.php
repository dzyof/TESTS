<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QestionOptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qestion Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qestion-option-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Qestion Option', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'qestion.text_qestion',
            'option_text',
            'correct_option',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
