<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'variantu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <!--    <pre>-->
    <!--        --><?php
    //              var_dump($test);
    //        ?>
    <!--    </pre>-->
    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>варіант відповіді</th>
            </tr>

            <?php
            foreach ($options as $qestion) {
                ?>
                <tr>
                    <td><?= $qestion->id ?></td>
                    <td><?= $qestion->option_text ?></td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>


    </div>

<!--    <code>--><?//= __FILE__ ?><!--</code>-->
</div>
