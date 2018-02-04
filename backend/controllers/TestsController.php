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

use backend\models\Tests as Person;
use backend\models\Qestion as House;
use backend\models\QestionOption as Room;

use backend\models\TestsSearch as PersonQuery;

//use backend\models\House;
//use backend\models\Person;
//use backend\models\Room;

/**
 * DynamicformDemo3Controller implements the CRUD actions for Person model.
 */
class TestsController extends Controller
{
    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Person model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $houses = $model->qestions;

        return $this->render('view', [
            'model' => $model,
            'houses' => $houses,
        ]);
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelPerson = new Person;
        $modelsHouse = [new House];
        $modelsRoom = [[new Room]];

        if ($modelPerson->load(Yii::$app->request->post())) {

            $modelsHouse = Model::createMultiple(House::classname());
            Model::loadMultiple($modelsHouse, Yii::$app->request->post());

            // validate person and houses models
            $valid = $modelPerson->validate();
            $valid = Model::validateMultiple($modelsHouse) && $valid;
            if (isset($_POST['QestionOption'][0][0])) {
                foreach ($_POST['QestionOption'] as $indexHouse => $rooms) {
                    foreach ($rooms as $indexRoom => $room) {
                        $data['QestionOption'] = $room;
                        $modelRoom = new Room;
                        $modelRoom->load($data);
                        $modelsRoom[$indexHouse][$indexRoom] = $modelRoom;
                        $valid = $modelRoom->validate();
                    }
                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPerson->save(false)) {
                        foreach ($modelsHouse as $indexHouse => $modelHouse) {

                            if ($flag === false) {
                                break;
                            }

                            $modelHouse->tests_id = $modelPerson->id;

                            if (!($flag = $modelHouse->save(false))) {
                                break;
                            }

                            if (isset($modelsRoom[$indexHouse]) && is_array($modelsRoom[$indexHouse])) {
                                foreach ($modelsRoom[$indexHouse] as $indexRoom => $modelRoom) {
                                    $modelRoom->qestion_id = $modelHouse->id;
                                    if (!($flag = $modelRoom->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();

//                        return $this->redirect('view', 'id' => $modelPerson->id]);
                        return $this->redirect( Url::toRoute(['view', 'id' => $modelPerson->id]));
//                        return Url::toRoute(['view', 'id' => $modelPerson->id]);
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
            'modelPerson' => $modelPerson,
            'modelsHouse' => (empty($modelsHouse)) ? [new House] : $modelsHouse,
            'modelsRoom' => (empty($modelsRoom)) ? [[new Room]] : $modelsRoom,
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelPerson = $this->findModel($id);
        $modelsHouse = $modelPerson->qestions;
        $modelsRoom = [];
        $oldRooms = [];

        if (!empty($modelsHouse)) {
            foreach ($modelsHouse as $indexHouse => $modelHouse) {
                $rooms = $modelHouse->options;
                $modelsRoom[$indexHouse] = $rooms;
                $oldRooms = ArrayHelper::merge(ArrayHelper::index($rooms, 'id'), $oldRooms);
            }
        }
        if ($modelPerson->load(Yii::$app->request->post())) {

            // reset
            $modelsRoom = [];

            $oldHouseIDs = ArrayHelper::map($modelsHouse, 'id', 'id');
            $modelsHouse = Model::createMultiple(House::classname(), $modelsHouse);
            Model::loadMultiple($modelsHouse, Yii::$app->request->post());
            $deletedHouseIDs = array_diff($oldHouseIDs, array_filter(ArrayHelper::map($modelsHouse, 'id', 'id')));

            // validate person and houses models
            $valid = $modelPerson->validate();
            $valid = Model::validateMultiple($modelsHouse) && $valid;

            $roomsIDs = [];
            if (isset($_POST['QestionOption'][0][0])) {
                foreach ($_POST['QestionOption'] as $indexHouse => $rooms) {
                    $roomsIDs = ArrayHelper::merge($roomsIDs, array_filter(ArrayHelper::getColumn($rooms, 'id')));
                    foreach ($rooms as $indexRoom => $room) {
                        $data['QestionOption'] = $room;
                        $modelRoom = (isset($room['id']) && isset($oldRooms[$room['id']])) ? $oldRooms[$room['id']] : new Room;
                        $modelRoom->load($data);
                        $modelsRoom[$indexHouse][$indexRoom] = $modelRoom;
                        $valid = $modelRoom->validate();
                    }
                }
            }

            $oldRoomsIDs = ArrayHelper::getColumn($oldRooms, 'id');
            $deletedRoomsIDs = array_diff($oldRoomsIDs, $roomsIDs);

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPerson->save(false)) {

                        if (! empty($deletedRoomsIDs)) {
                            Room::deleteAll(['id' => $deletedRoomsIDs]);
                        }

                        if (! empty($deletedHouseIDs)) {
                            House::deleteAll(['id' => $deletedHouseIDs]);
                        }

                        foreach ($modelsHouse as $indexHouse => $modelHouse) {

                            if ($flag === false) {
                                break;
                            }

                            $modelHouse->tests_id = $modelPerson->id;

                            if (!($flag = $modelHouse->save(false))) {
                                break;
                            }

                            if (isset($modelsRoom[$indexHouse]) && is_array($modelsRoom[$indexHouse])) {
                                foreach ($modelsRoom[$indexHouse] as $indexRoom => $modelRoom) {
                                    $modelRoom->qestion_id = $modelHouse->id;
                                    if (!($flag = $modelRoom->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
//                        return $this->redirect(['view', 'id' => $modelPerson->id]);
                        return $this->redirect(['view', 'id' => $modelPerson->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelPerson' => $modelPerson,
            'modelsHouse' => (empty($modelsHouse)) ? [new House] : $modelsHouse,
            'modelsRoom' => (empty($modelsRoom)) ? [[new Room]] : $modelsRoom
        ]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $name = $model->name_tests;
        $qestions = $this->findModelQ($model->id);
        foreach ($qestions as $qestion){
            $options = $this->findModelO($qestion->id);
            foreach ($options as $option){
                $option->delete();
            }
            $qestion->delete();
        }
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
// пошук питань
    protected function findModelQ($id)
    {
        if (($model = House::findAll([ 'tests_id' =>  $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //пошук варіантів відповідей
    protected function findModelO($id)
    {
        if (($model = Room::findAll([ 'qestion_id' =>  $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}