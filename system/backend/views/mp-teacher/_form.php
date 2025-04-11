<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseStringHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use backend\models\MpTeacher;
use backend\models\MpTeacherPayroll;
use backend\models\MpTeacherStatus;
use backend\models\MpTeacherPosition;
use backend\models\MpLocation;

/* @var $this yii\web\View */
/* @var $model backend\models\MpTeacher */
/* @var $form yii\widgets\ActiveForm */

$select_province = ArrayHelper::map(MpLocation::find()->select(['province_name'])->distinct()->asArray()->all(), function($model, $defaultValue) {
        return $model['province_name'];
    }, 'province_name'
);

$select_teacher_payroll = ArrayHelper::map(MpTeacherPayroll::find()->asArray()->all(), function($model, $defaultValue) {
        return $model['id'];
    }, 'name'
);

$select_teacher_status = ArrayHelper::map(MpTeacherStatus::find()->asArray()->all(), function($model, $defaultValue) {
        return $model['id'];
    }, 'name'
);

$select_teacher_position = ArrayHelper::map(MpTeacherPosition::find()->asArray()->all(), function($model, $defaultValue) {
        return $model['id'];
    }, 'name'
);

$select_city = $model->isNewRecord ? array() : ArrayHelper::map(MpLocation::find()->select(['city_name'])->where(['province_name' => $model->province])->distinct()->asArray()->all(), function($model, $defaultValue) {
        return $model['city_name'];
    }, 'city_name'
);

$select_district = $model->isNewRecord ? array() : ArrayHelper::map(MpLocation::find()->select(['district_name'])->where(['city_name' => $model->city])->distinct()->asArray()->all(), function($model, $defaultValue) {
        return $model['district_name'];
    }, 'district_name'
);

$code_digit  = 4;
$code_prefix = '';
$code_model  = MpTeacher::find()->select(['nip'])->orderBy(['nip' => SORT_DESC])->asArray()->one();
$code_init   = (int) BaseStringHelper::byteSubstr($code_model['nip'], strlen($code_prefix), strlen($code_prefix) + $code_digit);
$code_nip    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);

?>

<div class="mp-teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-lg-3">

            <?php 

            $image = $model->image && is_file(Yii::getAlias('@webroot') . $model->image) ? $model->image : '/images/no_photo.jpg';

            ?>

            <?= $form->field($model, 'image', [
                    'template' => '
                    {label}
                    <div id="preview">
                    <img id="img-preview" src="'. Url::base() . $image .'" alt="user image" />
                    </div>
                    {input}
                    {error}',
                ])->fileInput(['accept' => 'image/*']) ?>

            <?= $form->field($model, 'nip')->textInput(['maxlength' => true, 'value' => $model->isNewRecord ? $code_nip : $model->nip]) ?>

            <?= $form->field($model, 'nip_old')->textInput(['maxlength' => true, 'value' => $model->isNewRecord ? $code_nip : $model->nip]) ?>
            
            <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-lg-3">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'pob')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dob')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal Lahir',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->dob,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>

            <?= $form->field($model, 'doe')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal Masuk',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->doe,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>

            <?= $form->field($model, 'gender')->widget(Select2::classname(),[
                    'data' => [ 'M' => 'LAKI-LAKI', 'F' => 'PEREMPUAN', ],
                    'options' => [
                        'placeholder' => 'Pilih Kecamatan',
                        'value' => $model->isNewRecord ? 'M' : $model->gender,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'married_status')->widget(Select2::classname(),[
                    'data' => [ 'BELUM KAWIN' => 'BELUM KAWIN', 'KAWIN' => 'KAWIN', 'JANDA' => 'JANDA', 'DUDA' => 'DUDA', ],
                    'options' => [
                        'placeholder' => 'Pilih Kecamatan',
                        'value' => $model->isNewRecord ? 'BELUM KAWIN' : $model->married_status,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'education')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-lg-3">

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'national')->widget(Select2::classname(),[
                    'data' => [ 'WNI' => 'WNI', 'WNA' => 'WNA', ],
                    'options' => [
                        'placeholder' => 'Pilih Warganegara',
                        'value' => $model->isNewRecord ? 'WNI' : $model->national,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'province')->widget(Select2::classname(),[
                    'data' => $select_province,
                    'options' => [
                        'placeholder' => 'Pilih Provinsi',
                        'onChange' => '$.post("'.Url::base().'/reff/location?type=P&name='.'" + $(this).val(), function(data) {
                                what = JSON.parse(data);
                                $("#mpteacher-city").html(what.city);
                                $("#mpteacher-district").html(null);
                            }
                        );',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'city')->widget(Select2::classname(),[
                    'data' => $select_city,
                    'options' => [
                        'placeholder' => 'Pilih Kota / Kabupaten',
                        'onChange' => '$.post("'.Url::base().'/reff/location?type=C&name='.'" + $(this).val(), function(data) {
                                what = JSON.parse(data);
                                $("#mpteacher-district").html(what.district);
                            }
                        );',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'district')->widget(Select2::classname(),[
                    'data' => $select_district,
                    'options' => [
                        'placeholder' => 'Pilih Kecamatan',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'sub_district')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-lg-3">

            <?= $form->field($model, 'handphone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'id_teacher_position')->widget(Select2::classname(),[
                    'data' => $select_teacher_position,
                    'options' => [
                        'placeholder' => 'Pilih Jabatan Guru',
                        'value' => $model->isNewRecord ? '' : $model->id_teacher_position,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'id_teacher_payroll')->widget(Select2::classname(),[
                    'data' => $select_teacher_payroll,
                    'options' => [
                        'placeholder' => 'Pilih Jenis Gaji',
                        'value' => $model->isNewRecord ? '' : $model->id_teacher_payroll,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'id_teacher_status')->widget(Select2::classname(),[
                    'data' => $select_teacher_status,
                    'options' => [
                        'placeholder' => 'Pilih Status Guru',
                        'value' => $model->isNewRecord ? '' : $model->id_teacher_status,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$js = <<< JS


$('#mpteacher-image').on('change', function(e) {
    e.preventDefault();
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#img-preview').attr('src', '$image');
    }
}

JS;

$css = <<< CSS

#preview {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 0 0 20px;
}

#preview img {
    width: 100%;
    max-height: 220px;
}

CSS;

$this->registerJs($js);
$this->registerCss($css);

