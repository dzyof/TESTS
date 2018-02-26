<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Test system'

?>
<div class="site-index">

    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>назва тесту</th>
                <th>час на проходження</th>
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
            </tr>

            <?php
                }
            ?>

            </tbody>
        </table>
    </div>

</div>
