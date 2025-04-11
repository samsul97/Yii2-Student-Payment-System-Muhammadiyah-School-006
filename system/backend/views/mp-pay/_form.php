<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\MpPayType;

/* @var $this yii\web\View */
/* @var $model backend\models\MpPay */
/* @var $form yii\widgets\ActiveForm */

$select_type_pay = ArrayHelper::map(MpPayType::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);
?>

<div class="mp-pay-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

    	<div class="col-lg-3">

    		<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    	</div>

    	<div class="col-lg-3">

    		<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    	
    	</div>
    	
    	<div class="col-lg-3">

		    <?= $form->field($model, 'type')->widget(Select2::classname(),[
		        'data' => [ 'CREDIT' => 'CREDIT', 'CASH' => 'CASH', 'DISCOUNT' => 'DISCOUNT', ],
		        'options' => [
		            'placeholder' => 'Pilih Tipe Pembayaran',
		            'value' => $model->isNewRecord ? 'CASH' : $model->type,
		        ],
		        'pluginOptions' => [
		            'allowClear' => false
		            ],
		        ]);
		    ?>

		</div>

		<div class="col-lg-3">

		    <?= $form->field($model, 'type_pay')->widget(Select2::classname(),[
		        'data' => $select_type_pay,
		        'options' => [
		            'placeholder' => 'Pilih Jenis Pembayaran',
		            'value' => $model->isNewRecord ? 3 : $model->type_pay,
		        ],
		        'pluginOptions' => [
		            'allowClear' => false
		            ],
		        ]);
		    ?>

		 </div>

	</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
