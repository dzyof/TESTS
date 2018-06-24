<?php if (!Yii::$app->user->isGuest): ?>

    <div class="leave-comment">
        <h4>Залиште ваш коментарій</h4>
        <?php if (Yii::$app->session->getFlash('comment')): ?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php endif; ?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => ['articles/article', 'id' => $article_id ],
            'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form']]) ?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Write Message'])->label(false) ?>
            </div>
        </div>
        <button type="submit" class="btn send-btn">Залишити коментар</button>
        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>

<?php endif; ?>