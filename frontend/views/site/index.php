<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Tests system'

?>
<div class="site-index">

    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>назва тесту</th>
                <th>час на проходженян</th>
<!--                <th>Кількість проходжень</th>-->
<!--                <th>Середня оцінка</th>-->
            </tr>

            <?php
                foreach ($tests as $test) {
                    ?>
            <tr>
                <td><?= $test->id ?></td>
                <td>
                    <a href="<?= Url::to(['site/test', 'id'=> $test->id]) ?>">
                        <?= $test->name_tests ?></td>
                    </a>

                <td><?= $test->time_passing ?>  хв.</td>
<!--                <td>--><?//= $test->number_passing ?><!--</td>-->
<!--                <td>--><?//= $test->avarage_score ?><!--</td>-->
            </tr>

            <?php
                }
            ?>

            </tbody>
        </table>
    </div>

</div>
