<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "qestion_option".
 *
 * @property int $id
 * @property int $qestion_id
 * @property string $option_text
 * @property int $correct_option
 *
 * @property Question $qestion
 */
class QuestionOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qestion_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [[ 'option_text'], 'required'],
            [['qestion_id'], 'integer'],
            [['option_text'], 'string', 'max' => 255],
            [['correct_option'], 'string', 'max' => 255],
            [['qestion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['qestion_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qestion_id' => 'Question ID',
            'option_text' => 'Варіант відповіді',
            'correct_option' => 'Чи це є правильний варіант',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'qestion_id']);
    }
}
