<div class="collapse" id="update<?= $comment_id; ?>">
    <div class="card card-body">
        <?php if(!Yii::$app->user->isGuest):?>
            <div class="leave-comment">
                <h4>Залиште ваш коментарій</h4>
                <?php if(Yii::$app->session->getFlash('comment')):?>
                    <div class="alert alert-success" role="alert">
                        <? //= Yii::$app->session->getFlash('comment'); ?>
                    </div>
                <?php endif;?>
                <?php $form = \yii\widgets\ActiveForm::begin([
                    'action'=>['comment/update', 'id'=>$comment_id,'commentForm' => $commentForm  ],
                    'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form','data-pjax' => true]])?>
                <div class="form-group">
                    <div class="col-md-12">
                        <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
                    </div>
                </div>
                <button type="submit" class="btn send-btn">Post Comment</button>
                <?php \yii\widgets\ActiveForm::end();?>
            </div>
        <?php endif;?>
    </div>
</div>