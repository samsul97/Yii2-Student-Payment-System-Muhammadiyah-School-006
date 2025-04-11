<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use backend\models\MpStudent;
use backend\models\MpClass;
use backend\models\MpLevel;
use backend\models\MpYear;
use kartik\select2\Select2;

$value_student = $model->isNewRecord ? null : $model->nis;
$init_student  = empty($value_student) ? null : MpStudent::findOne($value_student)['full_name'];
$url_student   = Url::to(['reff/students']);

$select_level = array(0 => 'NONE') + ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
        return $model['type'] . ' - ' . $model['kelas_c'];
    }
);

$select_year = array(0 => 'NONE') + ArrayHelper::map(MpYear::find()->orderBy(['id' => SORT_DESC])->asArray()->all(),'id', function($model, $defaultValue) {
        return $model['nama'];
    }
);

$select_class = array(0 => 'NONE') + ArrayHelper::map(MpClass::find()->asArray()->all(),'id', function($model, $defaultValue) {
        return $model['name'];
    }
);

/* @var $this yii\web\View */
/* @var $model backend\models\MpGrade */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="mp-grade-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-lg-4">

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

            <?= $form->field($model, 'id_level')->widget(Select2::classname(),[
                    'data' => $select_level,
                    'options' => [
                        'placeholder' => 'Pilih Jenjang',
                        'value' => $model->isNewRecord ? 0 : $model->id_level,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>



        </div>

        <div class="col-lg-4">

            <?= $form->field($model, 'id_class')->widget(Select2::classname(),[
                    'data' => $select_class,
                    'options' => [
                        'placeholder' => 'Pilih Kelas',
                        'value' => $model->isNewRecord ? 0 : $model->id_class,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'id_year')->widget(Select2::classname(),[
                    'data' => $select_year,
                    'options' => [
                        'placeholder' => 'Pilih Tahun',
                        'value' => $model->isNewRecord ? 0 : $model->id_year,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

        </div>

        <div class="col-lg-4">

            <?= $form->field($model, 'status')->widget(Select2::classname(),[
                    'data' => [ 'LULUS' => 'LULUS', 'TIDAK LULUS' => 'TIDAK LULUS', ],
                    'options' => [
                        'placeholder' => 'Pilih Status',
                        'value' => $model->isNewRecord ? null : $model->status,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->date,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>

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
