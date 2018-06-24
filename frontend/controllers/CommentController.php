<?php

namespace frontend\controllers;

use frontend\models\CommentForm;
use Yii;
use backend\models\Comment;
use backend\models\CommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['articles/article?id='. $model->article_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionLike($id, $article_id = null )
    {
        $model = $this->findModel($id);
        $model->like += 1;
        $model->save();

         return $this->redirect(['articles/article?id='. $article_id]);
    }

//    public function actionLikeUp($id, $article_id = null)
//    {
//        $votes = Yii::$app->session->get('like');
//
//        var_dump($votes);
//        $model = $this->findModel($id);
//        $model->like += $votes;
//        $model->save();
//
//        Yii::$app->session->set('votes', $model->like);
//        return $this->redirect(['articles/article?id='. $article_id ]);
//    }
//
//    public function actionLikeDown()
//    {
//        $votes = Yii::$app->session->get('votes', 0);
//        Yii::$app->session->set('votes', --$votes);
//        return $this->render('vote');
//    }






    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $article_id)
    {
            $this->findModel($id)->delete();
            return $this->redirect(['articles/article?id='. $article_id]);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
