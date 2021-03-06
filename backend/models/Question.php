<?php

namespace backend\models;

use frontend\models\Rezult;
use Yii;

/**
 * This is the model class for table "qestion".
 *
 * @property int $id
 * @property int $tests_id
 * @property string $text_qestion
 *
 * @property Test $tests
 * @property QuestionOption[] $qestionOptions
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tests_id', 'text_qestion'], 'required'],
            [['tests_id'], 'integer'],
            [['text_qestion'], 'string', 'max' => 255],
            [['tests_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['tests_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tests_id' => 'ІD тесту',
            'text_qestion' => 'Текст запитання',
        ];
    }

    public function beforeDelete()
    {
        foreach ($this->options as $options) {
            $options->delete();
        }
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasOne(Test::className(), ['id' => 'tests_id']);
    }

    public function getOptions()
    {
        return $this->hasMany(QuestionOption::className(), ['qestion_id' => 'id']);
    }
}
