<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KoordinatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="koordinat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'a_lat') ?>

    <?= $form->field($model, 'a_lng') ?>

    <?= $form->field($model, 'b_lat') ?>

    <?= $form->field($model, 'b_lng') ?>

    <?php // echo $form->field($model, 'c_lat') ?>

    <?php // echo $form->field($model, 'c_lng') ?>

    <?php // echo $form->field($model, 'd_lat') ?>

    <?php // echo $form->field($model, 'd_lng') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
