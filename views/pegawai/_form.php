<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\bootstrap4\ActiveForm;
 */
?>


    <div class="pegawai-form">

        <?php $form = ActiveForm::begin(['id' => 'pegawai-form']); ?>

        <?= $form->field($model, 'id_golongan')->textInput() ?>

        <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

        <?php if (!empty($model->avatar)): ?>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <?= Html::img('@web/media/users/' . $model->avatar, ['width' => '50%', 'height' => '70%']) ?>
                    </td>
                    <td>
                        <?= Html::a('<i class="flaticon-delete"></i> Hapus', ['user/hapus-avatar', 'id' => $model->id], ['class' => 'btn btn-danger btn-round', 'data-method' => 'POST']) ?>
                    </td>
                </tr>
                </tbody>
            </table>
        <?php else: ?>
            <?= $form->field($model, 'avatar')->widget(\kartik\file\FileInput::className(), [
                'pluginOptions' => [
                    'theme' => 'explorer-fas',
                    'showUpload' => false,
                    'previewFileType' => 'any',
                    'fileActionSettings' => [
                        'showZoom' => true,
                        'showRemove' => false,
                        'showUpload' => false,
                    ],
                ]
            ]) ?>
        <?php endif; ?>

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