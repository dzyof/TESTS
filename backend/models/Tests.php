<?php

namespace backend\models;

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
 * @property Qestion[] $qestions
 */
class Tests extends \yii\db\ActiveRecord
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
            [['time_passing', 'number_passing', 'avarage_score'], 'integer'],
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
            'number_passing' => 'кількість проходжень',
            'avarage_score' => 'Середня оцінка',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQestions()
    {
        return $this->hasMany(Qestion::className(), ['tests_id' => 'id']);
    }
}
