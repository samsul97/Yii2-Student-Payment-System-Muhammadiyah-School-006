<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\MpPay;
use backend\models\MpYear;
use backend\models\MpLevel;
use backend\models\MpSchool;
use backend\models\MpPayList;
use backend\models\MpPayRemission;
use backend\models\MpPayTransact;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\number\NumberControl;
use yii\widgets\DetailView;
use yii\grid\GridView;

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

$select_paylist = array(0 => 'NONE') + ArrayHelper::map(MpPayList::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['type'];
}
);

$nis    = Yii::$app->request->get('nis');
$year   = Yii::$app->request->get('year');
$school = Yii::$app->request->get('school');
$level  = Yii::$app->request->get('level');
$tahun  = Yii::$app->request->get('tahun');
$bulan_ = Yii::$app->request->get('bulan');
$bulan  = [
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
][$bulan_];

/* @var $this yii\web\View */
/* @var $model backend\models\MpPayTransact */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Input Pembayaran Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Pembayaran Siswa', 'url' => ['index']];
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

            <div class="mp-pay-transact-form">

                <div class="row">

                    <div class="col-lg-4">

                        <?= DetailView::widget([
                            'model' => $studentDV,
                            'attributes' => [
                                [
                                    'format' => 'raw',
                                    'attribute' => 'image',
                                    'value' => function ($data) {

                                        $image = $data['image'] && is_file(Yii::getAlias('@webroot') . $data['image']) ? $data['image'] : '../images/no_photo.jpg';
                                        return Html::img(Url::base().$image, ['height' => '220']);
                                    },
                                ],
                            ],
                        ]) ?>

                    </div>

                    <div class="col-lg-4">

                        <?= DetailView::widget([
                            'model' => $studentDV,
                            'attributes' => [
                                'nis',
                                'nis_old',
                                [
                                    'attribute' => 'id_tahun',
                                    'value' => function ($data) {
                                        $model = MpYear::findOne($data['id_tahun']);
                                        return $model['nama'];
                                    }
                                ],
                                [
                                    'attribute' => 'id_sekolah',
                                    'value' => function ($data) {
                                        $model = MpSchool::findOne($data['id_sekolah']);
                                        return $model['name'];
                                    }
                                ],
                                [
                                    'attribute' => 'id_jenjang',
                                    'value' => function ($data) {
                                        $model = MpLevel::findOne($data['id_jenjang']);
                                        return $model['type'] . ' - ' . $model['kelas_c'];
                                    }
                                ],
                            ],
                        ]) ?>

                    </div>

                    <div class="col-lg-4">

                        <?= DetailView::widget([
                            'model' => $studentDV,
                            'attributes' => [
                                'status',
                                'full_name',
                                'nick_name',
                                [
                                    'label' => 'Tempat/Tgl Lahir',
                                    'value' => function ($data) {
                                        $date = explode('-', $data['dob']);
                                        return $data['pob'] . ', ' . sprintf('%s-%s-%s', $date[2], $date[1], $date[0]);
                                    }
                                ],
                                [
                                    'label' => 'Umur',
                                    'value' => function ($data) {

                                        $date1 = $data['dob'];
                                        $date2 = date('Y-m-d');
                                        // $diff = abs(strtotime($date2)-strtotime($date1));
                                        // $years = floor($diff / (365*60*60*24));
                                        // return $years . ' Tahun';

                                        $datetime1 = date_create($date1);
                                        $datetime2 = date_create($date2);
                                        $interval = date_diff($datetime1, $datetime2);
                                        return $interval->format('%y Tahun');
                                    }
                                ],
                            ],
                        ]) ?>

                    </div>

                </div>


                <?php $form = ActiveForm::begin(); ?>

                    <div class="row">

                        <h5><?=$bulan?> - <?=$tahun?></h5>

                        <div class="table-responsive table-nowrap">

                            <table class="table items table-bordered table-number">

                                <thead>

                                    <tr>
                                        <th style="text-align:center">No.</th>
                                        <th>Pembayaran</th>
                                        <th>Jenis</th>
                                        <th>Tipe</th>
                                        <th>Jumlah</th>
                                        <th>Diskon</th>
                                        <th>Tagihan</th>
                                        <th>Dibayar</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                        $nominal = 0;

                                        if ($payList)
                                        {

                                            foreach ($payList as $key => $value) 
                                            {
                                                $pay = \backend\models\MpPay::findOne(['id' => $value['id_pay']]);
                                                $pay_type = \backend\models\MpPayType::findOne(['id' => $pay['type_pay']]);
                                                $transact = \backend\models\MpPayTransact::findAll([
                                                    'bulan'      => $bulan_, 
                                                    'tahun'      => $tahun, 
                                                    'nis'        => $nis, 
                                                    'id_tahun'   => $year, 
                                                    'id_sekolah' => $school, 
                                                    'id_jenjang' => $level, 
                                                    'id_pay'     => $value['id_pay'],
                                                ]);

                                                $paid = 0;

                                                if ($transact) 
                                                {
                                                    foreach ($transact as $key => $val) 
                                                    {
                                                        $paid = $paid + $val['nominal'];
                                                    }
                                                }

                                                $discount = 0;
                                                $discount_status = '';
                                                $discount_ = MpPayRemission::findOne([
                                                    'bulan'      => $bulan_, 
                                                    'tahun'      => $tahun, 
                                                    'nis'        => $nis,
                                                    'id_tahun'   => $year,
                                                    'id_sekolah' => $school,
                                                    'id_jenjang' => $level,
                                                    'id_pay'     => $value['id_pay']
                                                ]);

                                                if ($discount_)
                                                {
                                                    if ($discount_['type'] == 'P')
                                                    {
                                                        $discount = ($discount_['value'] * $value['nominal'] / 100);
                                                        $discount_status = ' (' . $discount_['value'] . '%)';
                                                    }
                                                    else
                                                    {
                                                         $discount = $discount_['value'];
                                                    }
                                                }

                                                $billing = $value['nominal'] - $discount;
                                                $valuex  = $billing - $paid;


                                                // if ()

                                                echo '<tr>';
                                                echo '<td><input type="hidden" name="id[]" class="id" value="' . $value['id'] . '" /></td>';
                                                echo '<td><input type="hidden" name="id_pay[]" class="" value="' . $value['id_pay'] . '" />' . $pay['name'] . '</td>';
                                                echo '<td>' . $pay_type['name'] . '</td>';
                                                echo '<td><input type="hidden" name="id_tahun[]" class="" value="' . $value['id_tahun'] . '" />';
                                                echo     '<input type="hidden" name="id_sekolah[]" class="" value="' . $value['id_sekolah'] . '" />';
                                                echo     '<input type="hidden" name="id_jenjang[]" class="" value="' . $value['id_jenjang'] . '" />';
                                                echo     '<input type="hidden" name="type[]" class="" value="' . $value['type'] . '" />' . $value['type'] . '</td>';
                                                
                                                echo '<td><input type="hidden" name="id_paylist[]"  class="paylist" value="' . $value['nominal'] . '" /> ' . number_format($value['nominal'], 0) . '</td>';
                                                echo '<td><input type="hidden" name="discount[]"  class="discount" value="' . $discount . '" /> ' . number_format($discount, 0) . $discount_status . '</td>';
                                                echo '<td><input type="hidden" name="billing[]"  class="billing" value="' . $billing . '" /> ' . number_format($billing, 0) . '</td>';
                                                echo '<td><input type="hidden" name="paid[]"  class="paid" value="' . $paid . '" /> ' . number_format($paid, 0) . '</td>';
                                                echo '<td><input type="text"   name="nominal[]"" class="digit nominal form-control" value="' . $valuex . '" ' . ($value['type'] === 'CREDIT' ? '' : 'readonly') . '/></td>';

                                                echo '<td>' . ($valuex === 0 ? '<span style="color:greenyellow"><i class="fas fa-check"></i></span> LUNAS' : '<span style="color:tomato"><i class="fas fa-times"></i></span> BELUM LUNAS') . '</td>';
                                                echo '</tr>';

                                                $nominal = $nominal + $valuex;

                                            }

                                        }
                                        else
                                        {
                                            echo '<tr>';
                                            echo '<td style="display:none"></td>';
                                            echo '<td colspan="10"><center><i>Tidak ada list pembayaran</i></center></td>';
                                            echo '</tr>';
                                        }

                                    ?>

                                </tbody>    

                            </table>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-3">

                            <div class="form-group">
                                <?= Html::label('Tanggal', 'tanggal', ['class' => 'control-label']) ?>
                                <?= Html::textInput('tanggal', date('d-m-Y'), ['id' => 'tanggal', 'class' => 'form-control', 'readonly' => true]); ?>
                            </div>

                        </div>

                        <div class="col-lg-3">

                            <div class="form-group">
                                <?= Html::label('Total', 'total', ['class' => 'control-label']) ?>
                                <?= Html::textInput('total', $nominal, ['id' => 'total', 'class' => 'digit form-control', 'readonly' => true]); ?>
                            </div>

                        </div>

                        <div class="col-lg-3">

                            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'value' => $studentDV['nick_name']]) ?>

                        </div>
                        

                        <div class="col-lg-3">

                            <div class="form-group">
                                <?= Html::label('&nbsp;', 'pay', ['class' => 'control-label']) ?>
                                <div class="button-group">
                                    <?= Html::submitButton('Bayar', ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>

                        </div>

                    </div>

                <?php ActiveForm::end(); ?>

                <div class="row">

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
                                [
                                    'attribute' => 'bulan',
                                    'filter' => [
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
                                    'value' => function($data) {

                                        return [
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
                                                ][$data['bulan']];
                                    } 
                                ],
                                [
                                    'attribute' => 'tahun',
                                    'filter' => [

                                        date('Y', strtotime('-1 year')) => date('Y', strtotime('-1 year')),
                                        date('Y') => date('Y'),
                                        date('Y', strtotime('+1 year')) => date('Y', strtotime('+1 year'))
                                    ],
                                    'value' => function($data) {

                                        return $data['tahun'];
                                    }
                                ],
                                [
                                    'format' => 'raw',
                                    'headerOptions' => ['style' => 'text-align:center'],
                                    'contentOptions' => ['style' =>'text-align:left;'],
                                    'attribute' => 'id_pay',
                                    'filter' => $select_pay,
                                    'value' => function ($data) {
                                        $pay = MpPay::findOne(['id' => $data['id_pay']]);
                                        return $pay['name'] . ' - ' . $pay['description'];
                                    },
                                ],
                                [
                                    'attribute' => 'id_paylist',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return '<b>Rp. </b>' . number_format($model->id_paylist);
                                    },
                                    'headerOptions' => ['style' => 'text-align:center;'],
                                    'contentOptions' => ['style' => 'text-align:left;'],
                                ],
                                [
                                    'attribute' => 'disc_value',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return '<b>Rp. </b>' . number_format($model->disc_value);
                                    },
                                    'headerOptions' => ['style' => 'text-align:center;'],
                                    'contentOptions' => ['style' => 'text-align:left;'],
                                ],
                                [

                                    'attribute' => 'type',
                                    'filter' => ['CREDIT' => 'CREDIT', 'CASH' => 'CASH'],
                                ],
                                'name',
                                [
                                    'attribute' => 'nominal',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return '<b>Rp. </b>' . number_format($model->nominal);
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

</div>

<?php

$js = <<< JS


$('.digit').number(true);

$(document).on('change', '.nominal', function() {
    
    tes = $(this).closest('tr').find('.paid').val();
    tes2 = $(this).closest('tr').find('.billing').val();
    tes3 = parseInt(tes2) - parseInt(tes);
    
    if ($(this).val() > tes3) {
        $(this).val(tes3);
    }

    if (parseInt(tes) === parseInt(tes2)) {
        $(this).val(0);
    }

    val = 0;

    $('.nominal').each(function(e) {
        val_this = parseInt($(this).val());
        val = val + val_this;
    });

    $('#total').val(val);

});

JS;

$css = <<< CSS

.table-number {
    counter-reset: number;
}

.table-number tbody tr > td:first-child {
    counter-increment: number;
    vertical-align: middle;
    text-align: center;
}

.table-number tbody tr td:first-child::before {
    content: counter(number);
}

CSS;

$this->registerCss($css);
$this->registerJs($js);