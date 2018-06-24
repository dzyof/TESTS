<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

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

<!--    <div id="accordion">-->
<!---->
<!--        --><?php
//        foreach ($tests as $test) {
//            ?>
<!--            <div class="group">-->
<!--               <h3> --><?//= $test->name_tests ?><!-- Час для проходження тесту --><?//= $test->time_passing ?><!--хв. </h3>-->
<!--                <div>-->
<!--                    <a href="--><?//= Url::to(['site/test', 'id'=> $test->id]) ?><!--"> Розпочати тест</a>-->
<!--                    <p> Тут може бути опис для кожного тесту</p>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            --><?php
//        }
//        ?>
<!---->
<!---->
<!---->
<!---->
<!--</div>-->


    <?php Pjax::begin(); ?>
    <?= Html::beginForm(['site/form-submission'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
    <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
    <?= Html::submitButton('Получить хеш', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
    <?= Html::endForm() ?>
    <h3><?= $stringHash ?></h3>
    <?php Pjax::end(); ?>
