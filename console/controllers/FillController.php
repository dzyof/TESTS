<?php

namespace console\controllers;

use common\models\User;
use yii\console\ExitCode;
use backend\models\Test;
use backend\models\Qestion;
use backend\models\QestionOption;

class FillController extends \yii\console\Controller
{
    public function actionUser()
    {
        echo 'ZApovnutu usera i admina' . "\n";

        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@gmail.com';
        $user->setPassword(1);
        $user->generateAuthKey();
        $user->save();

        $user = new User();
        $user->username = 'user';
        $user->email = 'user@gmail.com';
        $user->setPassword(1);
        $user->generateAuthKey();
        $user->save();

        return ExitCode::OK;
    }

    public function actionTable()
    {


//        $test = new Test();
//        $test->id = 4;
//        $test->name_tests = 'Філософія2';
//        $test->time_passing = 1;
//        $test->save();
//
//        $qestion = new Qestion();
//        $qestion->tests_id = 4;
//        $qestion->id = 23;
//        $qestion->text_qestion = 'В чьому смисл життя';
//        $qestion->save();
//
//        $option = new QestionOption();
//        $option->qestion_id = 23;
//        $option->option_text = 'самоудосконалення';
//        $option->correct_option = 0;
//        $option->save();






//
//        $option = new QestionOption();
////        $option->qestion_id = 11;
//        $option->option_text = '42';
//        $option->correct_option = 1;
//        $option->save();
//
//        $option = new QestionOption();
////        $option->qestion_id = 11;
////        $option->option_text = 'кіт';
//        $option->correct_option = 1;
//        $option->save();

//        echo 'zapovnutu tablicy dannimi' . "\n";
        return ExitCode::OK;
    }
}
