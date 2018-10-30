<?php

use yii\grid\GridView;
use yii\helpers\Html;
    use yii\widgets\Pjax;
?>
<?php \yii\widgets\Pjax::begin(); ?>
<div class="site-index">
    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Титулка</th>
                <th>опис</th>
            </tr>
            <?php
            foreach ($model as $article) {
                ?>
                <tr>
                    <td> <?= $article->title ?></td>
                    <td> <?= $article->description ?></td>
                </tr>
                <?php
            } ?>
            </tbody>
        </table>
    </div>
</div>


<!--Відображення окремим темплейтом комент форми-->
    <?= $this->render('_coment-form',[
         'commentForm' => $commentForm,
        'article_id' => $article->id
    ]); ?>


<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment): ?>
        <?php if( $comment->approved){ ?>
        <div class="bottom-comment"><!--bottom comment-->
            <?php  if($comment->status){ echo '<p>Редаговано адміністратором</p>';  }  ?>
            <div class="comment-img">

                <?= Html::img('@web/images/avatar.jpg', ['alt' => 'avatar']) ?>

            </div>

            <div class="comment-text">
                <!--                <h5> --><? //= $comment->user->name;?><!--</h5>-->
                <h5> User  ID <?= $comment->user_id; ?> </h5>
<!--                // TODO change by user->name-->

                <p class="para"><?= $comment->text; ?></p>
            </div>
        </div>
        <p>
            <p>
            <p class="glyphicon glyphicon-heart"><?= $comment->like ?></p>

            <?php if (!Yii::$app->user->isGuest && Yii::$app->user->id != $comment->user_id): ?>
                <?= Html::a('Вподобати', ['comment/like', 'id' => $comment->id, 'article_id' => $article->id], [
                    'class' => 'btn btn-info',
                    'data' => [
                       'method' => 'post',
                    ],

                ]) ?>
            <?php endif; ?>

            <a class="btn btn-primary" data-toggle="collapse" href="#<?= $comment->id; ?>" role="button"
               aria-expanded="false" aria-controls="collapseExample">
                Залишити коментарій
            </a>
            <?php if (!Yii::$app->user->isGuest && Yii::$app->user->id == $comment->user_id): ?>
                <?= Html::a('Видалити', ['comment/delete', 'id' => $comment->id, 'article_id' => $article->id], [
                    'class' => 'btn btn-danger',
//                    'option' =>[
//                        'data-pjax' => true
//                    ],

                    'data' => [
                        'method' => 'post',
                ]]) ?>
                <?= Html::a('Редагувати', ['comment/update', 'id' => $comment->id ], [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
        </p>


         <?= $this->render('_colapse-form',[
            'comment_id' => $comment->id,
            'article_id' => $article->id,
            'commentForm' => $commentForm
        ]) ?>
        <?= $this->render('_colapse-form-update',[
            'comment_id' => $comment->id,
            'article_id' => $article->id,
            'commentForm' => $commentForm
        ]) ?>


        <?php $article->subComment($comment->id,$commentForm,$article->id); ?>
<!--        //, $article->id,$commentForm-->

        <?php }?>
    <?php endforeach; ?>
<?php endif; ?>

<?php  \yii\widgets\Pjax::end();?>
