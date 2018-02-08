<?php
namespace frontend\controllers;




use frontend\models\Rezult;
use frontend\models\RezultsOption;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use backend\models\Tests;
use backend\models\Qestion;
use backend\models\QestionOption;

use backend\models\MyModel as Model;

use backend\models\TestsSearch as PersonQuery;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $tests = Tests::find()->all();

        return $this->render('index', [
            'tests' => $tests,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionTest($id)
    {
        $modelRezult = new Rezult;
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
            if (isset($_POST['Qestion']) && $_POST['QestionOption']) {


                $modelRezultsOption = new RezultsOption;
                $modelRezultsOption->id = 1;
                $modelRezultsOption->rezult_id = 1;
                $modelRezultsOption->question  = '45454545';
                $modelRezultsOption->questions_answer = 'ghjgh';
                $modelRezultsOption->right_answer = 'fghfg';
                $modelRezultsOption->status = 1;
                $modelRezultsOption->save();





                $modelRezult->saveRezult(Yii::$app->request->post());

//                return $this->redirect(['rezult' ,
//                    'rezultate' => $modelRezult->saveRezult(Yii::$app->request->post())]);
                return $this->redirect(['rezult']);
            }
        }

//
//            // reset
//            $modelsRoom = [];
//
//            $oldHouseIDs = ArrayHelper::map($modelsHouse, 'id', 'id');
//            $modelsHouse = Model::createMultiple(House::classname(), $modelsHouse);
//            Model::loadMultiple($modelsHouse, Yii::$app->request->post());
//            $deletedHouseIDs = array_diff($oldHouseIDs, array_filter(ArrayHelper::map($modelsHouse, 'id', 'id')));
//
//            // validate person and houses models
//            $valid = $modelPerson->validate();
//            $valid = Model::validateMultiple($modelsHouse) && $valid;
//
//            $roomsIDs = [];
//            if (isset($_POST['QestionOption'][0][0])) {
//                foreach ($_POST['QestionOption'] as $indexHouse => $rooms) {
//                    $roomsIDs = ArrayHelper::merge($roomsIDs, array_filter(ArrayHelper::getColumn($rooms, 'id')));
//                    foreach ($rooms as $indexRoom => $room) {
//                        $data['QestionOption'] = $room;
//                        $modelRoom = (isset($room['id']) && isset($oldRooms[$room['id']])) ? $oldRooms[$room['id']] : new Room;
//                        $modelRoom->load($data);
//                        $modelsRoom[$indexHouse][$indexRoom] = $modelRoom;
//                        $valid = $modelRoom->validate();
//                    }
//                }
//            }
//
//            $oldRoomsIDs = ArrayHelper::getColumn($oldRooms, 'id');
//            $deletedRoomsIDs = array_diff($oldRoomsIDs, $roomsIDs);

//            if ($valid) {
//                $transaction = Yii::$app->db->beginTransaction();
//                try {
//                    if ($flag = $modelPerson->save(false)) {
//
//                        if (! empty($deletedRoomsIDs)) {
//                            Room::deleteAll(['id' => $deletedRoomsIDs]);
//                        }
//
//                        if (! empty($deletedHouseIDs)) {
//                            House::deleteAll(['id' => $deletedHouseIDs]);
//                        }
//
//                        foreach ($modelsHouse as $indexHouse => $modelHouse) {
//
//                            if ($flag === false) {
//                                break;
//                            }
//
//                            $modelHouse->tests_id = $modelPerson->id;
//
//                            if (!($flag = $modelHouse->save(false))) {
//                                break;
//                            }
//
//                            if (isset($modelsRoom[$indexHouse]) && is_array($modelsRoom[$indexHouse])) {
//                                foreach ($modelsRoom[$indexHouse] as $indexRoom => $modelRoom) {
//                                    $modelRoom->qestion_id = $modelHouse->id;
//                                    if (!($flag = $modelRoom->save(false))) {
//                                        break;
//                                    }
//                                }
//                            }
//                        }
//                    }
//                    if ($flag) {
//                        $transaction->commit();
////                        return $this->redirect(['view', 'id' => $modelPerson->id]);
//                        return $this->redirect(['view', 'id' => $modelPerson->id]);
//                    } else {
//                        $transaction->rollBack();
//                    }
//                } catch (Exception $e) {
//                    $transaction->rollBack();
//                }
//            }
//        }

        return $this->render('test', [
            'modelPerson' => $modelPerson,
            'modelsHouse' => (empty($modelsHouse)) ? [new Qestion] : $modelsHouse,
            'modelsRoom' => (empty($modelsRoom)) ? [[new QestionOption]] : $modelsRoom,

        ]);


//        $test = Qestion::find()->where(['tests_id' => $id])->all();
//
//        $options =[];
//        foreach ($test as $tes) {
//            array_push($options, QestionOption::find()->where(['qestion_id' => $tes->id])->all());
//        }
//        $timePassing = Tests::find()->where(['id' => $id])->one();
//        $timePass = $timePassing->time_passing;
//
//        return $this->render('test', [
//            'test' => $test,
//            'options' => $options,
//            'timePass' => $timePass
//        ]);
    }

    public function actionRezult(){
//        тут будуть оброблятися і зберігатися данні
         return $this->render('rezult');
    }


    protected function findModel($id)
    {
        if (($model = Tests::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
