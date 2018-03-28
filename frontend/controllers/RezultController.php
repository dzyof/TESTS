<?php

namespace frontend\controllers;

use backend\models\Question;
use backend\models\QuestionOption;
use DateTime;
use frontend\models\Rezult;
use frontend\models\RezultOption;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;


class RezultController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = Rezult::find()->orderBy('id DESC')->all();

        $model2 = Rezult::find();
        $pages = new Pagination(['totalCount' => $model2->count(), 'pageSize'=>5]);
        $pages->pageSizeParam = false;

        return $this->render('index', [
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    public function actionOption($id)
    {
        $model = RezultOption::find()->where(['rezult_id' => $id ])->all();
        return $this->render('option', [
            'model' => $model,
        ]);
    }

}
