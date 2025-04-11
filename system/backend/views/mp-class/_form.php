<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MpClass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mp-class-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

	    <div class="col-lg-4">

	    	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	    </div>

	    <div class="col-lg-6">

	    	<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

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
