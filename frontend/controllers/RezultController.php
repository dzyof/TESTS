<?php

namespace frontend\controllers;

use backend\models\Qestion;
use backend\models\QestionOption;
use DateTime;
use frontend\models\Rezults;
use Yii;
use yii\data\ActiveDataProvider;

class RezultController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = Rezults::find()->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }



    public function actionRezult()
    {
        $model = new Rezults();

        if (Yii::$app->request->post()) {
            $rezult =  Yii::$app->request->post();
            $userId = $rezult['user_id'];
            $trufalse = $model->countRez($rezult);
        }

        $date = new DateTime();

        $rezultt = new Rezults();
        $rezultt->user_id = $userId;
        $rezultt->test_id = $rezult['test_id'];
        $rezultt->correct_unswer = $trufalse[0];
        $rezultt->wrong_unswer = $trufalse[1];
        $rezultt->data_pass = $date->format('Y-m-d H:i:s');
        $rezultt->save();


        return $this->render('rezult', [
            'userId' => $userId,
            'trufalse'=>$trufalse,
//            'mustBeConttest' => $mustBeConttest,
        ]);
    }
}
