<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\MpLevel;
use backend\models\MpPay;
use backend\models\MpYear;
use backend\models\MpSchool;
use backend\models\MpStudent;
use backend\models\User;

$value_student = null;
$init_student  = empty($value_student) ? null : $value_student;
$url_student   = Url::to(['reff/students']);

$select_year = ArrayHelper::map(MpYear::find()->orderby(['id' => SORT_DESC])->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['nama'];
}
);

$select_level = ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
    return $model['type'] . ' - ' .  $model['kelas_c'];
}
);

$select_pay = ArrayHelper::map(MpPay::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_user = ArrayHelper::map(User::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_school = ArrayHelper::map(MpSchool::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
});

$select_student = ArrayHelper::map(MpStudent::find()->asArray()->all(),'nis', function($model, $defaultValue) {
    return $model['nis'] . '/' . $model['nis_old'] . ' - ' . $model['full_name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpPayRemissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mp Pay Remissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        
        <div class="card-text">
            <div class="mp-pay-remission-index">

                <p>

                    <div class="row">

                    <div class="col-lg-3">
                        <div class="form-group">
                            <?= Html::label('Siswa', 'nis', ['class' => 'control-label']) ?>
                            <?= Select2::widget([
                                'id' => 'nis',
                                'name' => 'nis',
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
                                        return result.text; 
                                     }'),
                                ],
                            ]) ?>
                        </div>
                    </div>

                        <div class="col-lg-3">

                            <div class="form-group">
                                <?= Html::label('Tahun', 'year', ['class' => 'control-label']) ?>
                                <?= Select2::widget(['id' => 'year',
                                    'name' => 'year',
                                    'data' => $select_year,
                                    'value' => 0,
                                    'options' => [
                                        'placeholder' => 'Pilih ...',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => false
                                    ],
                                ]) ?>
                                <?php // Html::hiddenInput('user_idlogin', null, ['id' => 'user_idlogin']); ?>
                            </div>

                        </div>

                        <div class="col-lg-3">

                            <?= HTml::label('Sekolah', 'school', ['class' => 'control-label']) ?>
                            <?= Select2::widget(['id' => 'school',
                                'name' => 'school',
                                'data' => $select_school,
                                'value' => 0,
                                'options' => [
                                    'placeholder' => 'Pilih ...',
                                    /*
                                    	'onChange' => '$.post("'.Url::base().'/reff/school?id='.'" + $(this).val(), function_exists(function_name)(data) {
                                            	what = JSON.parse(data);
                                            	$("#level").html(what.jenjang);
                                        	}
                                    	);',
                                    */
                                ],
                                'pluginOptions' => [
                                    'allowClear' => false
                                ],

                            ]) ?>

                        </div>

                        <div class="col-lg-3">

                            <div class="form-group">
                                <?= Html::label('Jenjang', 'level', ['class' => 'control-label']) ?>
                                <?= Select2::widget(['id' => 'level',
                                    'name' => 'level',
                                    'data' => $select_level,
                                    'value' => 0,
                                    'options' => [
                                        'placeholder' => 'Pilih ...',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => false
                                    ],
                                ]) ?>
                                
                            </div>
                        </div>

                    <div class="col-lg-3">

                        <div class="form-group">

                            <?= Html::label('Bulan Pembayaran', 'bulan', ['class' => 'control-label']) ?>
                            <?= Select2::widget(['id' => 'bulan',
                                'name' => 'bulan',
                                'data' => [
                                            1 => 'JANUARY', 
                                            2 => 'FEBRUARY', 
                                            3 => 'MARCH', 
                                            4 => 'APRIL', 
                                            5 => 'MAY', 
                                            6 => 'JUNE', 
                                            7 => 'JULY', 
                                            8 => 'AUGUST', 
                                            9 => 'SEPTEMBER', 
                                            10 => 'OCTOBER', 
                                            11 => 'NOVEMBER', 
                                            12 => 'DESEMBER'
                                ],
                                'value' => date('n'),
                                'options' => [
                                    'placeholder' => 'Pilih ...',
                                ],
                                'pluginOptions' => [
                                    'allowClear' => false
                                ],
                            ]) ?>
                            
                        </div>

                    </div>

                    <div class="col-lg-3">

                        <div class="form-group">

                            <?= Html::label('Tahun Pembayaran', 'tahun', ['class' => 'control-label']) ?>
                            <?= Select2::widget(['id' => 'tahun',
                                'name' => 'tahun',
                                'data' => [

                                    date('Y', strtotime('-1 year')) => date('Y', strtotime('-1 year')),
                                    date('Y') => date('Y'),
                                    date('Y', strtotime('+1 year')) => date('Y', strtotime('+1 year'))
                                ],
                                'value' => date('Y'),
                                'options' => [
                                    'placeholder' => 'Pilih ...',
                                ],
                                'pluginOptions' => [
                                    'allowClear' => false
                                ],
                            ]) ?>
                            
                        </div>

                    </div>


                        <div class="col-lg-3">

                            <div class="form-group">
                                <?= Html::label('&nbsp;', 'tambah', ['class' => 'control-label']) ?>
                                <div class="button-group">
                                    <?= Html::a('Tambah Transaksi', ['create'], ['class' => 'btn btn-success listing']) ?>
                                </div>
                            </div>

                        </div>

                    </div>

                </p>

                <div class="table-responsive table-nowrap">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'nis',
                            'id_tahun',
                            'id_sekolah',
                            'id_jenjang',
                            'id_pay',
                            'type',
                            'value',
                            'reason',
                            // 'id_user',
                            // 'timestamp',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                </div>

            </div>

        </div>

    </div>


</div>

<?php

$url_listing = Url::base().'/mp-pay-remission/listing?nis=';

$js = <<< JS


$(document).ready(function() {

    $('.pjax-delete-link').on('click', function(e) {
        e.preventDefault();
        var deleteUrl = $(this).attr('delete-url');
        var pjaxContainer = $(this).attr('pjax-container');
        Swal.fire({
            icon: 'warning',
            title: 'Apakah ingin mengapus data ?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            confirmButtonColor: '#dc3545',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: deleteUrl,
                    type: 'post',
                    error: function(xhr, status, error) {
                        alert('There was an error with your request.' + xhr.responseText);
                    },
                    success: function(data) {
                        swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.success ? 'success' : 'error',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: true
                        });
                    }
                }).done(function(data) {
                    $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: false});
                });
            }
        })
    });

    $(document).on('pjax:success', function(e) {

        $('.pjax-delete-link').on('click', function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('delete-url');
            var pjaxContainer = $(this).attr('pjax-container');
            Swal.fire({
                icon: 'warning',
                title: 'Apakah ingin mengapus data ?',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#dc3545',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'post',
                        error: function(xhr, status, error) {
                            alert('There was an error with your request.' + xhr.responseText);
                        },
                        success: function(data) {
                            swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: data.success ? 'success' : 'error',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: true
                            });
                        }
                    }).done(function(data) {
                        $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: false});
                    });
                }
            })
        });

    });

});

$(".listing").on("click", function(e) {
    e.preventDefault();
    nis = $('#nis').val();
    bulan = $('#bulan').val();
    tahun = $('#tahun').val();
    year = $('#year').val();
    level = $('#level').val();
    school = $('#school').val();
    url = '$url_listing' + nis + '&year=' + year + '&school=' + school + '&level=' + level + '&tahun=' + tahun + '&bulan=' + bulan;
    if (year && level) {
        /* $('#modalListing').modal('show')
            .find('.modal-body')
            .html('Loading ...')
            .load(url); */
        window.location = url;
    } else {
        swal.fire({
            title: 'Daftar Transaksi',
            text: 'Informasi belum lengkap',
            icon: 'error',
            timer: 5000,
            showCancelButton: false,
            showConfirmButton: true
        });
    }

});

$('#modalListing').on('hidden.bs.modal', function (e) {
    e.preventDefault();
    $('.modal-body').html('');
    // $.pjax.reload('#pjax-listing-index', {timeout: false});
});

JS;

$css = <<< CSS

CSS;

$this->registerCss($css);
$this->registerJs($js);

Modal::begin([
    'id' => 'modalListing',
    'size' => Modal::SIZE_LARGE,
    'title' => 'Daftar Transaksi',
]);

Modal::end();
