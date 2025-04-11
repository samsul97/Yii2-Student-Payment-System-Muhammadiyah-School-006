<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MpYear */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mp-year-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'semester')->dropDownList([ 'GENAP' => 'GENAP', 'GANJIL' => 'GANJIL', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'awal')->widget(DatePicker::classname(), [
     'removeButton' => false,
     'value' => date('Y-m-d'),
     'options' => ['placeholder' => 'Awal'],
     'pluginOptions' => [
       'autoclose'=>true,
       'format' => 'yyyy-mm-dd'
   ]])
   ?>

<?= $form->field($model, 'akhir')->widget(DatePicker::classname(), [
     'removeButton' => false,
     'value' => date('Y-m-d'),
     'options' => ['placeholder' => 'Akhir'],
     'pluginOptions' => [
       'autoclose'=>true,
       'format' => 'yyyy-mm-dd'
   ]])
   ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
