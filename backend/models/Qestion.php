<?php

namespace backend\models;

use frontend\models\Rezults;
use Yii;

/**
 * This is the model class for table "qestion".
 *
 * @property int $id
 * @property int $tests_id
 * @property string $text_qestion
 *
 * @property Tests $tests
 * @property QestionOption[] $qestionOptions
 */
class Qestion extends \yii\db\ActiveRecord
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
            [['tests_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::className(), 'targetAttribute' => ['tests_id' => 'id']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasOne(Tests::className(), ['id' => 'tests_id']);
    }


}
