<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model app\models\forms\koordinat\KoordinatForm */
/* @var $form yii\bootstrap4\ActiveForm;
 */
?>


    <div class="koordinat-form">

        <?php $form = ActiveForm::begin(['id' => 'koordinat-form']); ?>

        <?= $form->field($model, 'timurLaut')->textInput(['id' => 'timurLaut', 'readonly' => true]) ?>

        <?= $form->field($model, 'baratDaya')->textInput(['id' => 'baratDaya', 'readonly' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php $js = <<<JS
 $('form').on('beforeSubmit', function()
    {
        var form = $(this);
        //console.log('before submit');

        var submit = form.find(':submit');
        KTApp.block('.modal',{
            overlayColor: '#000000',
            type: 'v2',
            state: 'primary',
            message: 'Sedang Memproses...'
        });
        submit.html('<i class="flaticon2-refresh"></i> Sedang Memproses');
        submit.prop('disabled', true);

        KTApp.blockPage({
            overlayColor: '#000000',
            type: 'v2',
            state: 'primary',
            message: 'Sedang memproses...'
        });

    });

JS;

$this->registerJs($js);
?>