<?php

/* @var $this yii\web\View */

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
//        ?>
<!--    </pre>-->
    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>питання</th>
                <th>варіанти відповіді</th>
            </tr>

            <?php
            foreach ($test as $qestion) {
                ?>
                <tr>
                    <td><?= $qestion->id ?></td>
                    <td><?= $qestion->text_qestion ?></td>
                    <td>
                        <?php
                        foreach ($options as $option){
                            foreach ($option as $optio){
                                if ($qestion->id == $optio->qestion_id ){
                                    echo  $optio->option_text.'</br>' ;
                                }
                            }
                         }
                        ?>
                       </td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

<!--    <code>--><?//= __FILE__ ?><!--</code>-->
</div>
