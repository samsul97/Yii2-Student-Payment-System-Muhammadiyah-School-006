<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use kartik\number\NumberControl;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use backend\models\MpLevel;
use backend\models\MpPay;
use backend\models\MpPayList;
use backend\models\MpYear;
use backend\models\MpStudent;

$value_student = $model->isNewRecord ? null : $model->nis;
$init_student  = empty($value_student) ? null : MpStudent::find()->where(['nis' => $value_student])->one()['full_name'];
$url_student   = Url::to(['reff/students']);

$select_level = array(0 => 'NONE') + ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
    return $model['type'] . ' - ' . $model['kelas_c'];
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
/* @var $model backend\models\MpPayTransact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mp-pay-transact-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-lg-4">

            <?= $form->field($model, 'no')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nis')->widget(Select2::classname(),[
                'data' => [$value_student => $init_student],
                'options' => [
                    'value' => $value_student,
                    'placeholder' => 'Pilih Siswa ...',
                ],
                'pluginOptions' => [
                    'allowClear' => false,
                    'minimumInputLength' => 1,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => $url_student,
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term};}'),
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function (result) { return result.text; }'),
                    'templateSelection' => new JsExpression('function (result) { 
                        if (result.tahun) {
                            $("#year").val(result.tahun).trigger("change"); 
                        }
                        if (result.sekolah) {
                            $("#school").val(result.sekolah).trigger("change");
                        }
                        if (result.jenjang) {
                            $("#level").val(result.jenjang).trigger("change"); 
                        }
                        if (result.nama) {
                            $("#name").val(result.nama); 
                        }
                        return result.text; 
                     }'),
                ],
            ]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'datetime')->widget(DatePicker::classname(), [
                    'removeButton' => false,
                    'value' => date('Y-m-d'),
                    'options' => ['placeholder' => 'Date Time'],
                    'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]])
            ?>

        </div>

        <div class="col-lg-4">

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

            <?= $form->field($model, 'id_paylist')->widget(NumberControl::classname(), [
                'data' => 'number-decimal',
                'maskedInputOptions' => [
                    'digits' => 0,
                    'alias' => 'numeric',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'autoUnmask' => true,
                    'unmaskAsNumber' => true,
                ],
            ]); ?>
            
        </div>

        <div class="col-lg-4">

            <?= $form->field($model, 'type')->widget(Select2::classname(),[
                'data' => [ 'CASH' => 'CASH', 'DEBIT' => 'DEBIT', ],
                'options' => [
                    'placeholder' => 'Pilih Tipe Pembayaran',
                    'value' => $model->isNewRecord ? 0 : $model->type,
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
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'autoUnmask' => true,
                    'unmaskAsNumber' => true,
                ],
            ]); ?>

        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
