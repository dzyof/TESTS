<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

 <?= Html::tag('p', Html::encode($user->username), ['class' => 'username']) ?>
  <?= Html::tag('p', Html::encode($user->email), ['class' => 'useremail']) ?>

<div class="site-index">
 <div class="bs-example">
  <table class="table table-striped">
   <thead>
   <tr>
    <th>ІD тесту що проходився</th>
    <th>Дата проходження</th>
   </tr>
   <?php
   foreach ($rezulmoel as $test) {
       ?>
    <tr>
     <td>
      <a href="<?= Url::to(['rezult/option', 'id'=> $test->id]) ?>">
          <?= $test->id ?>
      </a>
     </td>
     <td> <?= $test->data_pass ?></td>
    </tr>
       <?php
   }
   ?>
   </tbody>
  </table>
 </div>
</div>

