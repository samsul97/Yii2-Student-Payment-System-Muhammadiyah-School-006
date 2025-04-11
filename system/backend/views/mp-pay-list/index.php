<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\MpLevel;
use backend\models\MpPay;
use backend\models\MpYear;
use backend\models\MpSchool;
use backend\models\User;

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

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpPayListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->registerCssFile('@web/dist/css/custom/jquery.growl.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);


$this->title = 'Daftar Transaksi';
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
            <div class="mp-pay-list-index">

                <p>

                    <div class="row">

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
                                    'onChange' => '$.post("'.Url::base().'/reff/school?id='.'" + $(this).val(), function(data) {
                                            what = JSON.parse(data);
                                            $("#level").html(what.jenjang);
                                        }
                                    );',
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
                                <?= Html::label('&nbsp;', 'tambah', ['class' => 'control-label']) ?>
                                <div class="button-group">
                                    <?= Html::a('Tambah Transaksi', ['create'], ['class' => 'btn btn-success listing']) ?>
                                </div>
                            </div>

                        </div>

                    </div>

                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <div class="table-responsive table-nowrap">

                <?php Pjax::begin([
                    'id' => 'pjax-listing-index',
                    'enableReplaceState' => true,
                    'enablePushState' => false,
                    'timeout' => false,
                    // 'clientOptions' => ['method' => 'POST']
                ]) ?> 

                <?= GridView::widget([
                    'id' => 'grid-listing-index',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center']
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_tahun',
                            'filter' => $select_year,
                            'value' => function ($data) {
                                $tahun = MpYear::find()->where(['id' => $data['id_tahun']])->asArray()->one();
                                return $tahun['nama'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_sekolah',
                            'filter' => $select_school,
                            'value' => function ($data) {
                                $sekolah = MpSchool::find()->where(['id' => $data['id_sekolah']])->asArray()->one();
                                return $sekolah['name'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_jenjang',
                            'filter' => $select_level,
                            'value' => function ($data) {
                                $jenjang = MpLevel::find()->where(['kelas' => $data['id_jenjang']])->asArray()->one();
                                return $jenjang['type'] . ' - ' . $jenjang['kelas_c'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_pay',
                            'filter' => $select_pay,
                            'value' => function ($data) {
                                $pay = MpPay::find()->where(['id' => $data['id_pay']])->asArray()->one();
                                return $pay['name'] . ' - ' . $pay['description'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'attribute' => 'type',
                            'filter' => [ 'CREDIT' => 'CREDIT', 'CASH' => 'CASH', 'DISCOUNT' => 'DISCOUNT', ],
                            'value' => function ($data) {
                                $type = [ 'CREDIT' => 'CREDIT', 'CASH' => 'CASH', 'DISCOUNT' => 'DISCOUNT', ];
                                return $type[$data['type']];
                            },
                        ],
                        [
                            'attribute' => 'nominal',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return '<b>Rp. </b>' . number_format($data['nominal'], 0, ",", ".");
                            },
                            'headerOptions' => ['style' => 'text-align:center;'],
                            'contentOptions' => ['style' => 'text-align:left;'],
                        ],
                        // [
                        //     'format' => 'raw',
                        //     'headerOptions' => ['style' => 'text-align:center'],
                        //     'contentOptions' => ['style' =>'text-align:center;'],
                        //     'attribute' => 'id_user',
                        //     'filter' => $select_user,
                        //     'value' => function ($data) {
                        //         $user = User::find()->where(['id' => $data['id_user']])->asArray()->one();
                        //         return $user['name'];
                        //     },
                        // ],
                        // 'timestamp',
                        
                        // ['class' => 'yii\grid\ActionColumn'],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Action',
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function($url, $model) {
                                    return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                        ['view', 'id' => $model['id']], 
                                        ['title' => 'View', 'data' => 
                                        ['pjax' => 1]
                                    ]);
                                },
                                'update' => function($url, $model) {
                                    return Html::a('<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>', 
                                        ['update', 'id' => $model['id']], 
                                        ['title' => 'Update', 'data' => 
                                        ['pjax' => 1]
                                    ]);
                                },
                                'delete' => function($url, $model) {
                                    return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                                        ['delete', 'id' => $model['id']], 
                                        ['title' => 'Delete', 
                                        'class' => 'pjax-delete-link',
                                        'delete-url' => $url,
                                        'pjax-container' => 'pjax-listing-index',
                                        // 'data' => ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 1],
                                    ]);
                                }
                            ]
                        ],
                    ],

                ]); ?>

                <?php Pjax::end() ?>

                </div>

            </div>

        </div>
    </div>
</div>

<?php

$url_listing = Url::base().'/mp-pay-list/listing?year=';

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
    year = $('#year').val();
    level = $('#level').val();
    school = $('#school').val();
    url = '$url_listing' + year + '&school=' + school + '&level=' + level;
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