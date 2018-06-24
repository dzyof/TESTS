<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

use yii\data\Pagination;
use yii\widgets\Pjax;
$this->title = 'Test system'
?>
<div class="site-index">
    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Назва статті</th>
                <th>Опис</th>
            </tr>
            <?php
            foreach ($model as $article) {
                ?>
                <tr>
                    <td>
                        <a href="<?= Url::to(['articles/article', 'id' => $article->id]) ?>">
                            <?= $article->title ?>
                        </a>
                    </td>
                    <td> <?= $article->description ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!---->
<!--<div class="ddd">-->
<!--    --><?php
//    echo \yii\widgets\LinkPager::widget([
//        'pagination'=>$pages,
//    ]);
//    ?>
<!--</div>-->


<?php Pjax::begin(['enablePushState' => false]); ?>
<?= Html::a('', ['articles/upvote'], ['class' => 'btn btn-lg btn-warning glyphicon glyphicon-arrow-up']) ?>
<?= Html::a('', ['articles/downvote'], ['class' => 'btn btn-lg btn-primary glyphicon glyphicon-arrow-down']) ?>
<h1><?= Yii::$app->session->get('votes', 0) ?></h1>
<?php Pjax::end(); ?>
