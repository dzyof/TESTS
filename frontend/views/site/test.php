<?php

/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'test';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

<!--    <pre>-->
<!--        --><?php
//              var_dump($test);
//?>
<!--    </pre>-->
    <div class="bs-example">
        <?= Html::beginForm(['rezult/rezult', 'id' => $id], 'post', ['enctype' => 'multipart/form-data']) ?>
        <table class="table table-striped">
            <thead>

            <tr>
                <th>#</th>
                <th>питання</th>
                <th>варіанти відповіді</th>
            </tr>
            <?= Html::hiddenInput('user_id', Yii::$app->user->id); ?>
            <?= Html::hiddenInput('test_id', Yii::$app->request->get()['id']); ?>
            <?php

            foreach ($test as $qestion) {
                ?>
                <tr>
                    <td><?= $qestion->id ?></td>
                    <td><?= $qestion->text_qestion ?></td>
                    <td>
                        <?php
                        foreach ($options as $option) {
                            foreach ($option as $optio) {
                                if ($qestion->id == $optio->qestion_id) {
                                    ?>
                                        <?= Html::checkbox($qestion->id."/".$optio->option_text, false, ['label' =>$optio->option_text]); ?>.<br>
                        <?php
                                }
                            }
                        } ?>
                       </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?= Html::submitButton('Отправить', ['class' => 'submit','id' => 'autoSend']) ?>
        <?= Html::endForm() ?>
    </div>

    Залишилося  часу <span class="seconds"> <?= $timePass * 60 ?></span>с.
    <script>

    </script>




</div>
