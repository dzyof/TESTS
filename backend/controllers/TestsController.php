<?php

namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

use backend\models\MyModel as Model;

use yii\web\Controller;

use backend\models\Test;
use backend\models\Qestion;
use backend\models\QestionOption;

use backend\models\TestSearch;

/**
 * DynamicformDemo3Controller implements the CRUD actions for Test model.
 */
class TestsController extends Controller
{
    /**
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $qestions = $model->qestions;

        return $this->render('view', [
            'model' => $model,
            'houses' => $qestions,
        ]);
    }

    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelTests = new Test;
        $modelsQestion = [new Qestion];
        $modelsQestionOption = [[new QestionOption]];

        if ($modelTests->load(Yii::$app->request->post())) {
            $modelsQestion = Model::createMultiple(Qestion::classname());
            Model::loadMultiple($modelsQestion, Yii::$app->request->post());

            // validate Test and Qestions models
            $valid = $modelTests->validate();
            $valid = Model::validateMultiple($modelsQestion) && $valid;
            if (isset($_POST['QestionOption'][0][0])) {
                foreach ($_POST['QestionOption'] as $indexQestion => $qestionOptions) {
                    foreach ($qestionOptions as $indexQestionOption => $qestionOption) {
                        $data['QestionOption'] = $qestionOption;
                        $modelQestionOption = new QestionOption;
                        $modelQestionOption->load($data);
                        $modelsQestionOption[$indexQestion][$indexQestionOption] = $modelQestionOption;
                        $valid = $modelQestionOption->validate();
                    }
                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelTests->save(false)) {
                        foreach ($modelsQestion as $indexQestion => $modelQestion) {
                            if ($flag === false) {
                                break;
                            }

                            $modelQestion->tests_id = $modelTests->id;

                            if (!($flag = $modelQestion->save(false))) {
                                break;
                            }

                            if (isset($modelsQestionOption[$indexQestion]) && is_array($modelsQestionOption[$indexQestion])) {
                                foreach ($modelsQestionOption[$indexQestion] as $indexQestionOption => $modelQestionOption) {
                                    $modelQestionOption->qestion_id = $modelQestion->id;
                                    if (!($flag = $modelQestionOption->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();

//                        return $this->redirect('view', 'id' => $modelTests->id]);
                        return $this->redirect(Url::toRoute(['view', 'id' => $modelTests->id]));
//                        return Url::toRoute(['view', 'id' => $modelTests->id]);
//
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelTests' => $modelTests,
            'modelsQestion' => (empty($modelsQestion)) ? [new Qestion] : $modelsQestion,
            'modelsQestionOption' => (empty($modelsQestionOption)) ? [[new QestionOption]] : $modelsQestionOption,
        ]);
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelTests = $this->findModel($id);
        $modelsQestion = $modelTests->qestions;
        $modelsQestionOption = [];
        $oldQestionOptions = [];

        if (!empty($modelsQestion)) {
            foreach ($modelsQestion as $indexQestion => $modelQestion) {
                $QestionOptions = $modelQestion->options;
                $modelsQestionOption[$indexQestion] = $QestionOptions;
                $oldQestionOptions = ArrayHelper::merge(ArrayHelper::index($QestionOptions, 'id'), $oldQestionOptions);
            }
        }
        if ($modelTests->load(Yii::$app->request->post())) {

            // reset
            $modelsQestionOption = [];

            $oldQestionIDs = ArrayHelper::map($modelsQestion, 'id', 'id');
            $modelsQestion = Model::createMultiple(Qestion::classname(), $modelsQestion);
            Model::loadMultiple($modelsQestion, Yii::$app->request->post());
            $deletedQestionIDs = array_diff($oldQestionIDs, array_filter(ArrayHelper::map($modelsQestion, 'id', 'id')));

            // validate Test and Qestions models
            $valid = $modelTests->validate();
            $valid = Model::validateMultiple($modelsQestion) && $valid;

            $QestionOptionsIDs = [];
            if (isset($_POST['QestionOption'][0][0])) {
                foreach ($_POST['QestionOption'] as $indexQestion => $QestionOptions) {
                    $QestionOptionsIDs = ArrayHelper::merge($QestionOptionsIDs, array_filter(ArrayHelper::getColumn($QestionOptions, 'id')));
                    foreach ($QestionOptions as $indexQestionOption => $QestionOption) {
                        $data['QestionOption'] = $QestionOption;
                        $modelQestionOption = (isset($QestionOption['id']) && isset($oldQestionOptions[$QestionOption['id']])) ? $oldQestionOptions[$QestionOption['id']] : new QestionOption;
                        $modelQestionOption->load($data);
                        $modelsQestionOption[$indexQestion][$indexQestionOption] = $modelQestionOption;
                        $valid = $modelQestionOption->validate();
                    }
                }
            }

            $oldQestionOptionsIDs = ArrayHelper::getColumn($oldQestionOptions, 'id');
            $deletedQestionOptionsIDs = array_diff($oldQestionOptionsIDs, $QestionOptionsIDs);

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelTests->save(false)) {
                        if (! empty($deletedQestionOptionsIDs)) {
                            QestionOption::deleteAll(['id' => $deletedQestionOptionsIDs]);
                        }

                        if (! empty($deletedQestionIDs)) {
                            Qestion::deleteAll(['id' => $deletedQestionIDs]);
                        }

                        foreach ($modelsQestion as $indexQestion => $modelQestion) {
                            if ($flag === false) {
                                break;
                            }

                            $modelQestion->tests_id = $modelTests->id;

                            if (!($flag = $modelQestion->save(false))) {
                                break;
                            }

                            if (isset($modelsQestionOption[$indexQestion]) && is_array($modelsQestionOption[$indexQestion])) {
                                foreach ($modelsQestionOption[$indexQestion] as $indexQestionOption => $modelQestionOption) {
                                    $modelQestionOption->qestion_id = $modelQestion->id;
                                    if (!($flag = $modelQestionOption->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
//                        return $this->redirect(['view', 'id' => $modelTests->id]);
                        return $this->redirect(['view', 'id' => $modelTests->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelPerson' => $modelTests,
            'modelsHouse' => (empty($modelsQestion)) ? [new Qestion] : $modelsQestion,
            'modelsRoom' => (empty($modelsQestionOption)) ? [[new QestionOption]] : $modelsQestionOption
        ]);
    }

    /**
     * Deletes an existing Test model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $name = $model->name_tests;
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
