<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MpLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mp-level-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

    	<div class="col-lg-4">

    		<?= $form->field($model, 'kelas')->textInput() ?>

    	</div>

    	<div class="col-lg-4">

    		<?= $form->field($model, 'kelas_c')->textInput(['maxlength' => true]) ?>

    	</div>

    	<div class="col-lg-4">

    		<?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    	</div>

    </div>

    <div class="row">

        <div class="col-md-12 col-md-offset-4 text-center">

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-warning']) ?>
            </div>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
