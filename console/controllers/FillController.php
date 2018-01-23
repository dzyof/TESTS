<?php

namespace console\controllers;
use common\models\User;
use yii\console\ExitCode;


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
        echo 'zapovnutu tablicy dannimi' . "\n";
        return ExitCode::OK;
    }

}