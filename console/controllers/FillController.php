<?php

namespace console\controllers;

use common\models\User;
use yii\console\ExitCode;
use backend\models\Test;
use backend\models\Question;
use backend\models\QuestionOption;

class FillController extends \yii\console\Controller
{
    public function actionUser()
    {
        echo 'ZApovnutu usera i admina' . "\n";

        $user = new User();
        $user->id = 1;
        $user->username = 'admin';
        $user->email = 'admin@gmail.com';
        $user->setPassword(1);
        $user->generateAuthKey();
        $user->save();

        $user = new User();
        $user->id = 2;
        $user->username = 'user';
        $user->email = 'user@gmail.com';
        $user->setPassword(1);
        $user->generateAuthKey();
        $user->save();

        return ExitCode::OK;
    }

}
