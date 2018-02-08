<?php

namespace frontend\models;

use backend\models\Qestion;
use backend\models\QestionOption;
use backend\models\Tests;
use common\models\User;
use DateTime;

use frontend\models\RezultsOption;

use Yii;

/**
 * This is the model class for table "rezults".
 *
 * @property int $id
 * @property int $user_id
 * @property string $data_pass
 * @property int $test_id
// * @property int $correct_unswer
 * @property int $wrong_unswer
 *
 * @property Tests $test
 * @property User $user
 */
class Rezult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rezults';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id' ], 'required'],
            [['user_id', 'test_id'], 'integer'],
            [['data_pass'], 'safe'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'data_pass' => 'Data Pass',
            'test_id' => 'Test ID',
            'correct_unswer' => 'Correct Unswer',
            'wrong_unswer' => 'Wrong Unswer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Tests::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    // старий варіант
    public function countRez($rezult)
    {
        $mustBeConttest = Qestion::find()->where(['tests_id' => $rezult['test_id']])->count();
        $right = 0;
        $unright =0;
        $conttest = 0;
        $i = 0;
        $arr =[];
        foreach ($rezult as $key => $rez) {
            if ($i >=2) {
                $qestAbsw = explode("/", $key);
                var_dump($qestAbsw);
//                    echo $qestAbsw[0]."__>";
//                    echo $qestAbsw[1]."</br>";
//                if ($qestAbsw[0] != '_csrf-frontend' || $qestAbsw[0] != 'user_id') {
                $test = QestionOption::find()->where(['qestion_id' => $qestAbsw[0]])->andWhere(['correct_option' => 1])->all();
                if ($test[0]->option_text == $qestAbsw[1]) {
                    $right++;
                } else {
                    $unright++;
                }
                $conttest++;
            }
            $i++;
        }
        if ($mustBeConttest > $conttest) {
            $unright +=  $mustBeConttest - $conttest;
        }
        array_push($arr, $right, $unright, $mustBeConttest);
        return $arr;
    }

    // новий варіант


    public function saveRezult($models){
        $date = new DateTime();

        $modelRezult = new Rezult;

        if( isset(Yii::$app->user->id)){
            $modelRezult->user_id =Yii::$app->user->id ;
        }
        $modelRezult->data_pass  = $date->format('Y-m-d H:i:s');
        if( isset($_POST['Tests']['id']) ){
            $modelRezult->test_id = $_POST['Tests']['id'];
        }
        $modelRezult->save();





        echo "<pre>";
        if (isset($_POST['Qestion']) && $_POST['QestionOption']):


                foreach ($_POST['QestionOption'] as $questionOption ):
//                        if ($questionOption->qestion_id == $qestion->id):
//                            var_dump($questionOption->option_text);
//                            var_dump($questionOption->correct_option);

//                            var_dump($questionOption);
                            foreach ($questionOption as $option):
//                                var_dump($option);
                                if ($option['option_text']){
                                    var_dump('1');

                                    $user = new User();
                                    $user->id = 34;
                                    $user->username = 'werwr';
                                    $user->email = 'sdfsf@ad';
                                    $user->save();



//                                    $modelRezultsOption = new RezultsOption;
//
//                                    $modelRezultsOption->id = 1;
//                                    $modelRezultsOption->rezult_id = 1;
//                                    $modelRezultsOption->question  = '45454545';
//                                    $modelRezultsOption->questions_answer = 'ghjgh';
//                                    $modelRezultsOption->right_answer = 'fghfg';
//                                    $modelRezultsOption->status = 1;
//                                    $modelRezultsOption->save();
//                                    var_dump($modelRezultsOption);

//                                    var_dump($option['option_text']);
//                                    var_dump($option['correct_option']);
//                                    foreach ($_POST['Qestion'] as  $qestion ):
//                                           if($qestion['id'] == $option['qestion_id'])
//                                            var_dump($qestion['text_qestion']);//
//                                    endforeach;
//////
                                }
                            endforeach;
//                endif;
                endforeach;

        endif;
//             var_dump($models);
        echo "</pre>";


        //-----------------------------

    }
}
