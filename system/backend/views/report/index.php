<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
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

$select_year = ArrayHelper::map(MpYear::find()->orderBy(['id' => SORT_DESC])->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['nama'];
}
);

$select_level = ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
    return $model['type'] . ' - ' . $model['kelas_c'];
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

$select_school = ArrayHelper::map(MpSchool::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
});

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpPayTransactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Pembayaran Siswa';
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

                <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                <div class="table-responsive table-nowrap">

                <?php

                $gridColumns = [
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
                                return $year['semester'] . ' - ' . $year['nama'];
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
                                return number_format($model->id_paylist, 2);
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
                                return number_format($model->nominal, 2);
                            },
                            'headerOptions' => ['style' => 'text-align:center;'],
                            'contentOptions' => ['style' => 'text-align:left;'],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Action',
                            'template' => '{print}',
                            'buttons' => [
                            'print' => function($url, $model) {
                                    return Html::a('<button class="btn btn-sm btn-warning"><i class="fa fa-print"></i></button>', 
                                        ['print', 'no' => $model['no']], 
                                        ['title' => 'Print', 'target' => '_blank']);
                                }
                            ]
                        ],
                    ];

                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'filename' => 'report-transact',
                ]);

                ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns
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

JS;

$css = <<< CSS

CSS;

$this->registerCss($css);
$this->registerJs($js);
