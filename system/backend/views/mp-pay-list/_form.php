<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\MpLevel;
use backend\models\MpPay;
use backend\models\MpYear;
use kartik\number\NumberControl;

$select_level = array(0 => 'NONE') + ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
    return $model['kelas_c'];
}
);

$select_year = array(0 => 'NONE') + ArrayHelper::map(MpYear::find()->orderBy(['id' => SORT_DESC])->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['nama'];
}
);

$select_pay = array(0 => 'NONE') + ArrayHelper::map(MpPay::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);
/* @var $this yii\web\View */
/* @var $model backend\models\MpPayList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mp-pay-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_jenjang')->widget(Select2::classname(),[
            'data' => $select_level,
            'options' => [
                'placeholder' => 'Pilih Jenjang',
                'value' => $model->isNewRecord ? 0 : $model->id_jenjang,
            ],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]);
    ?>

    <?= $form->field($model, 'id_tahun')->widget(Select2::classname(),[
            'data' => $select_year,
            'options' => [
                'placeholder' => 'Pilih Tahun',
                'value' => $model->isNewRecord ? 0 : $model->id_tahun,
            ],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]);
    ?>
    
    <?= $form->field($model, 'id_pay')->widget(Select2::classname(),[
        'data' => $select_pay,
        'options' => [
            'placeholder' => 'Pilih Pembayaran',
            'value' => $model->isNewRecord ? 0 : $model->id_pay,
        ],
        'pluginOptions' => [
            'allowClear' => false
            ],
        ]);
    ?>
    
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

    <?= $form->field($model, 'nominal')->widget(NumberControl::classname(), [
        'data' => 'number-decimal',
        'maskedInputOptions' => [
            'digits' => 0,
            'alias' => 'numeric',
            'groupSeparator' => '.',
            'autoGroup' => true,
            'autoUnmask' => true,
            'unmaskAsNumber' => true,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
