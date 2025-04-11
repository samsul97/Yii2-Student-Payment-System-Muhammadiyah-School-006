<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\MpLevel;
use backend\models\MpPay;
use backend\models\MpPayList;
use backend\models\MpYear;
use backend\models\MpStudent;
use backend\models\MpSchool;

$value_student = null;
$init_student  = empty($value_student) ? null : $value_student;
$url_student   = Url::to(['reff/students']);

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

$select_pay = ArrayHelper::map(MpPay::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_paylist = ArrayHelper::map(MpPayList::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['type'];
}
);

$select_student = ArrayHelper::map(MpStudent::find()->asArray()->all(),'nis', function($model, $defaultValue) {
    return $model['nis'] . '/' . $model['nis_old'] . ' - ' . $model['full_name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpPayTransactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Pembayaran Siswa';
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
            <div class="mp-pay-transact-index">

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
                            <?= Html::label('Tahun Ajaran', 'year', ['class' => 'control-label']) ?>
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
                                /*'onChange' => '$.post("'.Url::base().'/reff/school?id='.'" + $(this).val(), function(data) {
                                        what = JSON.parse(data);
                                        $("#level").html(what.jenjang);
                                    }
                                );',*/
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

                    <div class="col-lg-6">

                        <div class="form-group">
                            <?= Html::label('&nbsp;', 'level', ['class' => 'control-label']) ?>
                            <div class="button-group">
                                <?= Html::a('Tambah Transaksi', ['input'], ['class' => 'btn btn-success transact']) ?>
                                <?= Html::a('Tambah Diskon', ['mp-pay-remission/listing'], ['class' => 'btn btn-primary remission']) ?>
                            </div>
                        </div>

                    </div>

                </div>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <div class="table-responsive table-nowrap">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center']
                        ],
                        'no',
                        'nis',
                        'datetime',
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_tahun',
                            'filter' => $select_year,
                            'value' => function ($data) {
                                $year = MpYear::findOne($data['id_tahun']);
                                return $year['nama'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_sekolah',
                            'filter' => $select_school,
                            'value' => function ($data) {
                                $school = MpSchool::findOne($data['id_sekolah']);
                                return $school['name'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_jenjang',
                            'filter' => $select_level,
                            'value' => function ($data) {
                                $level = MpLevel::findOne($data['id_jenjang']);
                                return $level['type'] . ' - ' . $level['kelas_c'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_pay',
                            'filter' => $select_pay,
                            'value' => function ($data) {
                                $pay = MpPay::findOne($data['id_pay']);
                                return $pay['name'];
                            },
                        ],
                        [
                            'attribute' => 'id_paylist',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return '<b>Rp. </b>' . number_format($model->id_paylist, 2);
                            },
                            'headerOptions' => ['style' => 'text-align:center;'],
                            'contentOptions' => ['style' => 'text-align:left;'],
                        ],
                        [
                            'attribute' => 'type',
                            'filter' => ['CASH' => 'CASH', 'CREDIT' => 'CREDIT'],
                            'value' => function ($model) {
                                return ['CASH' => 'CASH', 'CREDIT' => 'CREDIT'][$model['type']];
                            },
                            'headerOptions' => ['style' => 'text-align:center;'],
                            'contentOptions' => ['style' => 'text-align:left;'],
                        ],
                        'name',
                        [
                            'attribute' => 'nominal',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return '<b>Rp. </b>' . number_format($model->nominal, 2);
                            },
                            'headerOptions' => ['style' => 'text-align:center;'],
                            'contentOptions' => ['style' => 'text-align:left;'],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Action',
                            'template' => '{print} {view} {update} {delete}',
                            'buttons' => [
                            'print' => function($url, $model) {
                                return Html::a('<button class="btn btn-sm btn-warning"><i class="fa fa-print"></i></button>', 
                                    ['print', 'no' => $model['no']], 
                                    ['title' => 'Print', 'target' => '_blank']);
                            },
                            'view' => function($url, $model) {
                                return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                    ['view', 'id' => $model['id']], 
                                    ['title' => 'View']);
                            },
                            'update' => function($url, $model) {
                                return Html::a('<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>', 
                                    ['update', 'id' => $model['id']], 
                                    ['title' => 'Update']);
                            },
                            'delete' => function($url, $model) {
                                return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                                    ['delete', 'id' => $model['id']], 
                                    ['title' => 'Delete']);
                                }
                            ]
                        ],
                    ],
                ]); ?>

                </div>

            </div>

        </div>

    </div>
    
</div>

<?php

$js = <<< JS


$('.transact').on('click', function(e) {

    e.preventDefault();
    window.location = $(this).attr('href') + '?year=' + $('#year').val() + '&school=' + $('#school').val() + '&level=' + $('#level').val() + '&nis=' + $('#nis').val() + '&bulan=' + $('#bulan').val() + '&tahun=' + $('#tahun').val();

});

$('.remission').on('click', function(e) {

    e.preventDefault();
    window.location = $(this).attr('href') + '?year=' + $('#year').val() + '&school=' + $('#school').val() + '&level=' + $('#level').val() + '&nis=' + $('#nis').val() + '&bulan=' + $('#bulan').val() + '&tahun=' + $('#tahun').val();

});

JS;

$css = <<< CSS

CSS;

$this->registerCss($css);
$this->registerJs($js);
