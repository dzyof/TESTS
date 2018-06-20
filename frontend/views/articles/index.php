<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\LinkPager;

use yii\data\Pagination;


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
                        <a href="<?= Url::to(['articles/article', 'id'=> $article->id]) ?>">
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
