<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qestions';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="qestion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Qestion', ['dynamic/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'last_name',
            'first_name',
//            'tests.name_tests',
//            'text_qestion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</html>

