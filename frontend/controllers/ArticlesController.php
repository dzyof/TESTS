<?php

namespace frontend\controllers;

use frontend\models\Comment;
use Yii;
use backend\models\Article;
use backend\models\ArticleSearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticlesController implements the CRUD actions for Article model.
 */
class ArticlesController extends Controller
{

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Article::find()->orderBy('id DESC')->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionArticle($id)
    {
        $model = Article::find()->where(['id' => $id ])->all();
        $comments = Comment::find()->where(['article_id' => $id ])->andWhere(['comment_id' => Null])->all();

        return $this->render('article', [
            'model' => $model,
            'comments'=> $comments,
//            'comments_com'=>$comments_com
        ]);
    }








}
