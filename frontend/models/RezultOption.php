<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rezults_option".
 *
 * @property int $id
 * @property int $rezult_id
 * @property string $question
 * @property string $questions_answer
 * @property string $right_answer
 * @property int $status
 *
 * @property Rezult $rezult
 */
class RezultOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rezults_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rezult_id', 'question', 'questions_answer', 'right_answer', 'status'], 'required'],
            [['rezult_id', 'status'], 'integer'],
            [['question', 'questions_answer', 'right_answer'], 'string', 'max' => 255],
            [['rezult_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rezult::className(), 'targetAttribute' => ['rezult_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rezult_id' => 'Rezult ID',
            'question' => 'Question',
            'questions_answer' => 'Questions Answer',
            'right_answer' => 'Right Answer',
        ];
    }

}
