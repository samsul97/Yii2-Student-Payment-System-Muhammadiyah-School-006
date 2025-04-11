<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\models\MpLevel;
use backend\models\MpPay;
use backend\models\MpPayList;
use backend\models\MpYear;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\number\NumberControl;

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
/* @var $model backend\models\MpPayTransactSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mp-pay-transact-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">

        <div class="col-lg-3">

            <?php

            echo '<div class="form-group ">';
            echo '<label class="control-label">Tanggal Awal</label>';
            echo '<div class="input-group drp-container">';
            echo DatePicker::widget([
                'name' => 'start_date',
                'type' => DatePicker::TYPE_INPUT,
                'value' => Yii::$app->request->get('start_date') ?: date('d/m/Y'),
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]); 
            echo '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>';
            echo '</div>';
            echo '</div>';

            ?>

            <?php

            echo '<div class="form-group ">';
            echo '<label class="control-label">Tanggal Akhir</label>';
            echo '<div class="input-group drp-container">';
            echo DatePicker::widget([
                'name' => 'end_date',
                'type' => DatePicker::TYPE_INPUT,
                'value' => Yii::$app->request->get('end_date') ?: date('d/m/Y'),
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]); 
            echo '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>';
            echo '</div>';
            echo '</div>';

            ?>

        </div>

        <div class="col-lg-3">

            <?= $form->field($model, 'nis')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-lg-3">

            <?= $form->field($model, 'id_jenjang')->widget(Select2::classname(),[
                    'data' => $select_level,
                    'options' => [
                        'placeholder' => 'Pilih Jenjang',
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
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

        </div>

        <div class="col-lg-3">
                    
            <?= $form->field($model, 'id_pay')->widget(Select2::classname(),[
                'data' => $select_pay,
                'options' => [
                    'placeholder' => 'Pilih Pembayaran',
                ],
                'pluginOptions' => [
                    'allowClear' => false
                    ],
                ]);
            ?>
            
            <?= $form->field($model, 'type')->widget(Select2::classname(),[
                'data' => [ 'CASH' => 'CASH', 'DEBIT' => 'DEBIT', ],
                'options' => [
                    'placeholder' => 'Pilih Tipe Pembayaran',
                ],
                'pluginOptions' => [
                    'allowClear' => false
                    ],
                ]);
            ?>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12 col-md-offset-4 text-center">

            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
                <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
            </div>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
