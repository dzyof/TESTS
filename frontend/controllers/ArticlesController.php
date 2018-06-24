<?php

namespace frontend\controllers;

use frontend\models\Comment;
use frontend\models\CommentForm;
use Yii;
use backend\models\Article;
use yii\web\Controller;


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

    public function actionArticle($id, $comment_id = null)
    {
        $commentForm = new CommentForm();

        if (Yii::$app->request->isPost) {
            $commentForm->load(Yii::$app->request->post());
            $commentForm->saveComment($id, $comment_id);
            $this->refresh();
//            if($commentForm->saveComment($id))
//            {
//                Yii::$app->getSession()->setFlash('comment', 'Ваш коментарь успішно додано');
//            }
        }

        $model = Article::find()->where(['id' => $id])->all();
        $comments = Comment::find()->where(['article_id' => $id])->andWhere(['comment_id' => Null])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('article', [
            'model' => $model,
            'comments' => $comments,
            'commentForm' => $commentForm
//            'comments_com'=>$comments_com
        ]);
    }

    public function actionUpvote()
    {
        $model = Article::find()->orderBy('id DESC')->all();

        $votes = Yii::$app->session->get('votes', 0);
        Yii::$app->session->set('votes', ++$votes);
        return $this->render('index',[
            'model' => $model
            ] );
    }

    public function actionDownvote()
    {
        $model = Article::find()->orderBy('id DESC')->all();

        $votes = Yii::$app->session->get('votes', 0);
        Yii::$app->session->set('votes', --$votes);
        return $this->render('index',[
            'model' => $model
        ] );
    }
}
