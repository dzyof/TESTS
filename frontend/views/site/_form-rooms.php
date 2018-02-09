<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 4,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsRoom[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'option_text',
        'correct_option'
    ],
]); ?>
    <table class="table table-bordered">

        <tbody class="container-rooms">
        <?php foreach ($modelsRoom as $indexRoom => $modelRoom): ?>
            <tr class="room-item">
                <td class="vcenter">
                    <?php
                    // necessary for update action.
                    if (! $modelRoom->isNewRecord) {
                        echo Html::activeHiddenInput($modelRoom, "[{$indexHouse}][{$indexRoom}]id");
                        echo Html::activeHiddenInput($modelRoom, "[{$indexHouse}][{$indexRoom}]qestion_id");
                        echo Html::activeHiddenInput($modelRoom, "[{$indexHouse}][{$indexRoom}]correct_option");
                    }
                    ?>
                    <?= $form->field($modelRoom, "[{$indexHouse}][{$indexRoom}]option_text")->label($modelRoom->option_text)->checkbox(['value' =>$modelRoom->option_text]); ?>
                    </td>
<!--                <td class="vcenter">-->
<!--                    --><?//= $form->field($modelRoom, "[{$indexHouse}][{$indexRoom}]correct_option")->label($modelRoom->option_text)->checkbox() ?>
<!--                </td>-->
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php DynamicFormWidget::end(); ?>