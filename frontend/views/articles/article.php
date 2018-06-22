

<div class="site-index">
    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Титулка</th>
                <th>опис</th>
            </tr>
            <?php use yii\helpers\Html;

            foreach ($model as $article) {
                ?>
                <tr>
                    <td> <?= $article->title?></td>
                    <td> <?= $article->description ?></td>
                </tr>
                <?php
            } ?>
            </tbody>
        </table>
    </div>
</div>

<?php if(!Yii::$app->user->isGuest):?>
    <div class="leave-comment">
        <h4>Залиште ваш коментарій</h4>
        <?php if(Yii::$app->session->getFlash('comment')):?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php endif;?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action'=>['articles/article', 'id'=>$article->id],
            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
            </div>
        </div>
        <button type="submit" class="btn send-btn">Post Comment</button>
        <?php \yii\widgets\ActiveForm::end();?>
    </div>
<?php endif;?>

<?php if(!empty($comments)):?>
    <?php foreach($comments as $comment):?>
        <div class="bottom-comment"><!--bottom comment-->
            <div class="comment-img">
                <?= Html::img('@web/images/avatar.jpg', ['alt' => 'avatar']) ?>
            </div>

            <div class="comment-text">
<!--                <h5> --><?//= $comment->user->name;?><!--</h5>-->
                <h5> Name   Defoult </h5>

                <p class="para"><?= $comment->text; ?></p>
            </div>
        </div>

        <p>
        <p>

            <?= Html::a( $comment->like.'  Вподобати' , ['comment/like', 'id' => $comment->id, 'article_id'=>$article->id ], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>

            <a class="btn btn-primary" data-toggle="collapse" href="#<?= $comment->id; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                Залишити коментарій
            </a>
        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->id == $comment->user_id):?>
            <?= Html::a('Delete', ['comment/delete', 'id' => $comment->id, 'article_id'=>$article->id ], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>

<!--            <a class="btn btn-primary" data-toggle="collapse" href="#update--><?//= $comment->id; ?><!--" role="button" aria-expanded="false" aria-controls="collapseExample">-->
<!--                Редагувати коментар-->
<!--            </a>-->
        <?php endif;?>
        </p>
        <div class="collapse" id="<?= $comment->id; ?>">
            <div class="card card-body">
                <?php if(!Yii::$app->user->isGuest):?>
                    <div class="leave-comment">
                        <h4>Залиште ваш коментарій</h4>
                        <?php if(Yii::$app->session->getFlash('comment')):?>
                            <div class="alert alert-success" role="alert">
                                <?= Yii::$app->session->getFlash('comment'); ?>
                            </div>
                        <?php endif;?>
                        <?php $form = \yii\widgets\ActiveForm::begin([
                            'action'=>['articles/article', 'id'=>$article->id,'comment_id' => $comment->id ],
                            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
                        <div class="form-group">
                            <div class="col-md-12">
                                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
                            </div>
                        </div>
                        <button type="submit" class="btn send-btn">Post Comment</button>
                        <?php \yii\widgets\ActiveForm::end();?>
                    </div>
                <?php endif;?>
            </div>
        </div>

<!--        <div class="collapse" id="update--><?//= $comment->id; ?><!--">-->
<!--            <div class="card card-body">-->
<!--                --><?php //if(!Yii::$app->user->isGuest):?>
<!--                    <div class="leave-comment">-->
<!--                        <h4>Залиште ваш коментарій</h4>-->
<!--                        --><?php //if(Yii::$app->session->getFlash('comment')):?>
<!--                            <div class="alert alert-success" role="alert">-->
<!--                                --><?//= Yii::$app->session->getFlash('comment'); ?>
<!--                            </div>-->
<!--                        --><?php //endif;?>
<!--                        --><?php //$form = \yii\widgets\ActiveForm::begin([
//                            'action'=>['comment/update', 'id'=>$comment->id ,'$article_id' => $article->id ],
//                            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
<!--                        <div class="form-group">-->
<!--                            <div class="col-md-12">-->
<!--                                --><?//= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
<!--                            </div>-->
<!--                        </div>-->
<!--                        <button type="submit" class="btn send-btn">Post Comment</button>-->
<!--                        --><?php //\yii\widgets\ActiveForm::end();?>
<!--                    </div>-->
<!--                --><?php //endif;?>
<!--            </div>-->
<!--        </div>-->


       <?php $article->subComment($comment->id,$article->id); ?>
    <?php endforeach;?>
<?php endif;?>