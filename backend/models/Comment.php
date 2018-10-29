<?php

namespace backend\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property int $article_id
 * @property int $comment_id
 * @property int $status
 */
class Comment extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $imagename;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'comment_id','approved', 'status'], 'integer'],
            [['text','imagename'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'article_id' => 'Article ID',
            'comment_id' => 'Comment ID',
            'approved' => 'Approved',
            'imagename' =>'imagename',
            'imageFile' => 'Image',
            'status' => 'Status',
        ];
    }

}
