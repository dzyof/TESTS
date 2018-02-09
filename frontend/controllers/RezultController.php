<?php

namespace frontend\controllers;

use backend\models\Qestion;
use backend\models\QestionOption;
use DateTime;
use frontend\models\Rezult;
use frontend\models\RezultsOption;
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
        $model = RezultsOption::find()->where(['rezult_id' => $id ])->all();
        return $this->render('option', [
            'model' => $model,
        ]);
    }

//
//    public function actionRezult()
//    {
//        $model = new Rezult();
//
//        if (Yii::$app->request->post()) {
//            $rezult =  Yii::$app->request->post();
//            $userId = $rezult['user_id'];
//            $trufalse = $model->countRez($rezult);
//        }
//
//        $date = new DateTime();
//
//        $rezultt = new Rezult();
//        $rezultt->user_id = Yii::$app->user->id;
//        $rezultt->test_id = $rezult['test_id'];
//        $rezultt->data_pass = $date->format('Y-m-d H:i:s');
//        $rezultt->save();
//
//
//        return $this->render('rezult', [
//            'userId' => $userId,
//            'trufalse'=>$trufalse,
////            'mustBeConttest' => $mustBeConttest,
//        ]);
//    }
}
