<?php

namespace backend\models;

use frontend\models\Rezult;
use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property int $id
 * @property string $name_tests
 * @property int $time_passing
 * @property int $number_passing
 * @property int $avarage_score
 * @property double $created_at
 *
 * @property Question[] $qestions
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_tests', 'time_passing'], 'required'],
            [['time_passing', 'avarage_score'], 'integer'],
            [['created_at'], 'number'],
            [['name_tests'], 'string', 'max' => 255],
            [['name_tests'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_tests' => 'Назва тесту',
            'time_passing' => 'Час для проходження в хв.',
            'avarage_score' => 'Середня оцінка',
            'created_at' => 'Created At',
        ];
    }

    public function beforeDelete()
    {
        foreach ($this->qestions as $qestion) {
            $qestion->delete();
        }
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQestions()
    {
        return $this->hasMany(Question::className(), ['tests_id' => 'id']);
    }

    public function getRezults()
    {
        return $this->hasMany(Rezult::className(), ['test_id' => 'id']);
    }
}
