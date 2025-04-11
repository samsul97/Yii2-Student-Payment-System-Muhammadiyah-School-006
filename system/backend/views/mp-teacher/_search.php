<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MpTeacherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mp-teacher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'nip_old') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'pob') ?>

    <?= $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'doe') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'married_status') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'national') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'sub_district') ?>

    <?php // echo $form->field($model, 'postcode') ?>

    <?php // echo $form->field($model, 'handphone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'id_teacher_position') ?>

    <?php // echo $form->field($model, 'id_teacher_payroll') ?>

    <?php // echo $form->field($model, 'id_teacher_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
