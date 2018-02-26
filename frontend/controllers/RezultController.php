<?php

namespace frontend\controllers;

use backend\models\Question;
use backend\models\QuestionOption;
use DateTime;
use frontend\models\Rezult;
use frontend\models\RezultOption;
use Yii;
use yii\data\ActiveDataProvider;

class RezultController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = Rezult::find()->orderBy('id DESC')->all();

        return $this->render('index', [
            'model' => $model,
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
