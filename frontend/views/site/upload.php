<?php
use yii\widgets\ActiveForm;

?>

<?php if($model->imageFile): ?>
    <img src="/images/<?= $model->imageFile?>" alt="">
<?php endif; ?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'imageFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>