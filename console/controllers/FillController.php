<?php

namespace console\controllers;

use backend\models\Article;
use backend\models\Comment;
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

    public function actionArticleCommment()
    {
        echo 'zapovnennia statti' . "\n";

        $article = new Article();
        $article->id = 1;
        $article->title = 'Перша тестова стаття';
        $article->description = 'Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Morbi mollis tellus ac sapien. Phasellus ullamcorper ipsum rutrum nunc.
                                 Nam eget dui. Aliquam lobortis. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est.';
        $article->content = 'Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Morbi mollis tellus ac sapien. Phasellus ullamcorper ipsum rutrum nunc.
                             Nam eget dui. Aliquam lobortis. Pellentesque e';
        $article->category_id = 1;
        $article->save();


        $comment = new Comment();
        $comment->id = 1;
        $comment->text ='Aenean commodo ligula eget dolor. Vivamus aliquet elit ac nisl.
                        Integer ante arcu, accumsan a, consectetuerolutpat a, suscipit non, turpis.';
        $comment->article_id = 1;
        $comment->comment_id = null;
        $comment->like = 5;
        $comment->user_id = 1;
        $comment->save();


        $comment = new Comment();
        $comment->id = 2;
        $comment->text ='  ligula eget dolor. Vivamus aliquet elit ac ni Aenean commodosl.
                        Integer ante arcu, accumsan a, consectetuerolutpat a, suscipit non, turpis.';
        $comment->article_id = 1;
        $comment->comment_id = 1;
        $comment->like = 20;
        $comment->user_id = 1;
        $comment->save();

        $comment = new Comment();
        $comment->id = 3;
        $comment->text ='  ligula eget dolor. Vivamus aliquet elit ac ni Aenean commodosl.
                        Integer ante arcu, accumsan a, consectetuerolutpat a, suscipit non, turpis.';
        $comment->article_id = 1;
        $comment->comment_id = 2;
        $comment->like = 2;
        $comment->user_id = 1;
        $comment->save();

        $comment = new Comment();
        $comment->id = 4;
        $comment->text ='  ligula eget dolor. Vivamus aliquet elit ac ni Aenean commodosl.
                        Integer ante arcu, accumsan a, consectetuerolutpat a, suscipit non, turpis.';
        $comment->article_id = 1;
        $comment->comment_id = null;
        $comment->like = 2;
        $comment->user_id = 2;
        $comment->save();

    }

}
