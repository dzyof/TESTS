<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;
    
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    public function saveComment($article_id, $comment_id = null)
    {
        $comment = new Comment;
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->comment_id = $comment_id ;// савити ід коментаря
        $comment->status = 0;
        return $comment->save();
    }
}