<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Tests system'

?>
<div class="site-index">

    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ІD тесту що проходився</th>
                <th>ід користувача який проходив тест</th>
                <th>Дата проходження</th>
                <th>Кількість правильних відповідей</th>
                <th>Кількість неправильних відповідей</th>
            </tr>

                        <?php
                        foreach ($model as $test) {
                            ?>
                            <tr>
                                <td> <?= $test->id ?></td>
                                <td> <?= $test->user_id ?></td>
                                <td> <?= $test->data_pass ?></td>
                                <td><?= $test->correct_unswer ?> </td>
                                <td><?= $test->wrong_unswer ?></td>


                            </tr>
                            <?php
                        }
                        ?>

            </tbody>
        </table>
    </div>


</div>
