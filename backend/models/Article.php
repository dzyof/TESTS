<?php

namespace backend\models;

use frontend\models\Comment;
use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $date
 * @property string $image
 * @property int $viewed
 * @property int $user_id
 * @property int $status
 * @property int $category_id
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'content'], 'string'],
            [['date'], 'safe'],
            [['viewed', 'user_id', 'status', 'category_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
            'category_id' => 'Category ID',
        ];
    }

//    Виведення всіх підкоментарів
    public function subComment($comments_id ,$commentForm,$article_id){
        $comments_com = Comment::find()->all();
        if ($comments_com):

            foreach($comments_com as $comm):
                if(($comments_id == $comm->comment_id && $comm->approved )):?>

                <div class="sub-bottom-comment ">
                    <?php  if($comm->status){ echo '<p>Редаговано адміністратором</p>';  }  ?>
                     <div class="comment-img">
                        <?= Html::img('@web/images/avatar.jpg', ['alt' => 'avatar']) ; ?>
                     </div>
                    <h5> User  ID <?= $comm->user_id; ?> </h5>
                     <div class="comment-text">
                             <p class="para"> <?= $comm->text; ?></p>
                     </div>

                    <p class="glyphicon glyphicon-heart"><?= $comm->like ?></p>

                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->id != $comm->user_id): ?>
                        <?= Html::a('Вподобати', ['comment/like', 'id' => $comm->id, 'article_id' => $article_id], [
                            'class' => 'btn btn-info',
                            'data' => [
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php endif; ?>

<!--                    Кнопка і Форма в випадаючому меню коментаря Початок -->
                    <a class="btn btn-primary" data-toggle="collapse" href="#<?= $comm->id; ?>" role="button"
                       aria-expanded="false" aria-controls="collapseExample">
                        Залишити коментарій
                    </a>
                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->id == $comm->user_id): ?>
                    <!--                    Кнопка видалити коментар  START-->
                    <?= Html::a('Видалити', ['comment/delete', 'id' => $comm->id, 'article_id' => $article_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'method' => 'post',
                            'data-pjax'=>1
                        ],
                    ]) ?>
                    <!--                           Кнопка видалити коментар END-->

                    <?= Html::a('Редагувати', ['comment/update', 'id' =>$comm->id ], [
                        'class' => 'btn btn-warning',
                        'data' => [
                            'method' => 'post',
                            'data-pjax'=>1
                        ],
                    ]) ?>
                    <?php endif; ?>
                    <div class="collapse" id="<?=  $comm->id; ?>">
                        <div class="card card-body">
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <div class="leave-comment">
                                    <h4>Залиште ваш коментарій</h4>
                                    <?php if (Yii::$app->session->getFlash('comment')): ?>
                                        <div class="alert alert-success" role="alert">
                                            <?= Yii::$app->session->getFlash('comment'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php $form = \yii\widgets\ActiveForm::begin([
                                        'action' => ['articles/article', 'id' => $article_id, 'comment_id' =>  $comm->id],
                                        'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form','data-pjax' => true]]) ?>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Write Message'])->label(false) ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn send-btn">Post Comment</button>
                                    <?php \yii\widgets\ActiveForm::end(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

<!--                    Кнопка і Форма в випадаючому меню коментаря Ksytwm -->



                      <?= $this->subComment($comm->id,$commentForm,$article_id);?>
                </div>

               <?php  endif;
            endforeach;
        endif;
    }
}
?>
