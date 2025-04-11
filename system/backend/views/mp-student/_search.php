<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MpStudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mp-student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nis') ?>

    <?= $form->field($model, 'nis_old') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'id_tahun') ?>

    <?php // echo $form->field($model, 'id_jenjang') ?>

    <?php // echo $form->field($model, 'full_name') ?>

    <?php // echo $form->field($model, 'nick_name') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'pob') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'nation') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'orphan') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'address_type') ?>

    <?php // echo $form->field($model, 'sub_district') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'postcode') ?>

    <?php // echo $form->field($model, 'handphone') ?>

    <?php // echo $form->field($model, 'live') ?>

    <?php // echo $form->field($model, 'school_origin') ?>

    <?php // echo $form->field($model, 'other_information') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
