

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
       <?php $article->subComment($comment->id); ?>
    <?php endforeach;?>
<?php endif;?>

<!-- end bottom comment-->
<!---->
<?php //if(!Yii::$app->user->isGuest):?>
<!--    <div class="leave-comment"><!--leave comment-->
<!--        <h4>Leave a reply</h4>-->
<!--        --><?php //if(Yii::$app->session->getFlash('comment')):?>
<!--            <div class="alert alert-success" role="alert">-->
<!--                --><?//= Yii::$app->session->getFlash('comment'); ?>
<!--            </div>-->
<!--        --><?php //endif;?>
<!--        --><?php //$form = \yii\widgets\ActiveForm::begin([
//            'action'=>['site/comment', 'id'=>$article->id],
//            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
<!--        <div class="form-group">-->
<!--            <div class="col-md-12">-->
<!--                --><?//= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
<!--            </div>-->
<!--        </div>-->
<!--        <button type="submit" class="btn send-btn">Post Comment</button>-->
<!--        --><?php //\yii\widgets\ActiveForm::end();?>
<!--    </div><!--end leave comment-->
<?php //endif;?>