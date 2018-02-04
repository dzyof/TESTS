<?php

namespace frontend\models;

use backend\models\Qestion;
use backend\models\QestionOption;
use backend\models\Tests;
use common\models\User;
use Yii;

/**
 * This is the model class for table "rezults".
 *
 * @property int $id
 * @property int $user_id
 * @property string $data_pass
 * @property int $test_id
 * @property int $correct_unswer
 * @property int $wrong_unswer
 *
 * @property Tests $test
 * @property User $user
 */
class Rezults extends \yii\db\ActiveRecord
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
            [['user_id', 'test_id', 'correct_unswer', 'wrong_unswer'], 'required'],
            [['user_id', 'test_id', 'correct_unswer', 'wrong_unswer'], 'integer'],
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
}
