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
                <th>ІD тесту що проходився</th>
                <th>ід користувача який проходив тест</th>
                <th>Дата проходження</th>
            </tr>
            <?php
                        foreach ($model as $test) {
                            ?>
                            <tr>
                                <td>
                                <a href="<?= Url::to(['rezult/option', 'id'=> $test->id]) ?>">
                                    <?= $test->id ?>
                                </a>
                                </td>
                                    <td> <?= $test->user_id ?></td>
                                    <td> <?= $test->data_pass ?></td>
                            </tr>
                            <?php
                        }
                        ?>
            </tbody>
        </table>
    </div>
</div>
<div class="ddd">
        <?php
        echo \yii\widgets\LinkPager::widget([
            'pagination'=>$pages,
        ]);
        ?>
</div>
