<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseStringHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use backend\models\MpStudent;
use backend\models\MpLocation;
use backend\models\MpLevel;
use backend\models\MpYear;
use backend\models\MpSchool;

/* @var $this yii\web\View */
/* @var $model backend\models\MpStudent */
/* @var $form yii\widgets\ActiveForm */

$select_province = ArrayHelper::map(MpLocation::find()->select(['province_name'])->distinct()->asArray()->all(), function($model, $defaultValue) {
        return $model['province_name'];
    }, 'province_name'
);

$select_city = $model->isNewRecord ? array() : ArrayHelper::map(MpLocation::find()->select(['city_name'])->where(['province_name' => $model->province])->distinct()->asArray()->all(), function($model, $defaultValue) {
        return $model['city_name'];
    }, 'city_name'
);

$select_district = $model->isNewRecord ? array() : ArrayHelper::map(MpLocation::find()->select(['district_name'])->where(['city_name' => $model->city])->distinct()->asArray()->all(), function($model, $defaultValue) {
        return $model['district_name'];
    }, 'district_name'
);

$select_school = ArrayHelper::map(MpSchool::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_level = ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
    return $model['type'] . ' - ' . $model['kelas_c'];
}
);

$select_year = ArrayHelper::map(MpYear::find()->orderBy(['id' => SORT_DESC])->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['nama'];
}
);

$code_digit  = 5;
$code_prefix = '';
$code_model  = MpStudent::find()->select(['nis'])->orderBy(['id' => SORT_DESC, 'nis' => SORT_DESC])->asArray()->one();
$code_init   = (int) BaseStringHelper::byteSubstr($code_model['nis'], strlen($code_prefix), strlen($code_prefix) + $code_digit);
$code_nis    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);

?>

<div class="mp-student-form">

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

            <?= $form->field($model, 'status')->widget(Select2::classname(),[
                    'data' => [ 'REGISTER' => 'REGISTER', 'STUDENT' => 'STUDENT', ],
                    'options' => [
                        'placeholder' => 'Pilih Type',
                        'value' => $model->isNewRecord ? 'STUDENT' : $model->status,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'nis')->textInput(['maxlength' => true, 'value' => $model->isNewRecord ? $code_nis : $model->nis]) ?>

            <?= $form->field($model, 'nis_old')->textInput(['maxlength' => true, 'value' => $model->isNewRecord ? $code_nis : $model->nis]) ?>

        </div>

        <div class="col-lg-3">

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

            <?= $form->field($model, 'id_sekolah')->widget(Select2::classname(),[
                    'data' => $select_school,
                    'options' => [
                        'placeholder' => 'Pilih Sekolah',
                        'value' => $model->isNewRecord ? 0 : $model->id_sekolah,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

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

            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nick_name')->textInput(['maxlength' => true]) ?>

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
            
        </div>

        <div class="col-lg-3">

            <?= $form->field($model, 'gender')->widget(Select2::classname(),[
                    'data' => [ 'M' => 'LAKI-LAKI', 'F' => 'PEREMPUAN', ],
                    'options' => [
                        'placeholder' => 'Pilih Jenis Kelamin',
                        'value' => $model->isNewRecord ? 'M' : $model->gender,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'religion')->widget(Select2::classname(),[
                    'data' => [ 'Islam' => 'Islam', 'Kristen' => 'Kristen', 'Hindu' => 'Hindu', 'Budha' => 'Budha', 'Konghucu' => 'Konghucu', ],
                    'options' => [
                        'placeholder' => 'Pilih Agama',
                        'value' => $model->isNewRecord ? 'Islam' : $model->religion,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?> 
            
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address_type')->widget(Select2::classname(),[
                    'data' => [ 'Orang Tua' => 'Orang Tua', 'Asrama' => 'Asrama', 'Kost' => 'Kost', ],
                    'options' => [
                        'placeholder' => 'Pilih Tipe Alamat',
                        'value' => $model->isNewRecord ? 'Orang Tua' : $model->address_type,
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
                                $("#mpstudent-city").html(what.city);
                                $("#mpstudent-district").html(null);
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
                                $("#mpstudent-district").html(what.district);
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

        </div>

        <div class="col-lg-3">

            <?= $form->field($model, 'nation')->widget(Select2::classname(),[
                    'data' => [ 'WNI' => 'WNI', 'WNA' => 'WNA', ],
                    'options' => [
                        'placeholder' => 'Pilih Warganegara',
                        'value' => $model->isNewRecord ? 'WNI' : $model->nation,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'sub_district')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>            

            <?= $form->field($model, 'handphone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'orphan')->widget(Select2::classname(),[
                    'data' => [ 'Yatim' => 'Yatim', 'Piatu' => 'Piatu', 'Yatim Piatu' => 'Yatim Piatu', ],
                    'options' => [
                        'placeholder' => 'Pilih Orphan',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'school_origin')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'other_information')->textInput(['maxlength' => true]) ?>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$js = <<< JS


$('#mpstudent-image').on('change', function(e) {
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
