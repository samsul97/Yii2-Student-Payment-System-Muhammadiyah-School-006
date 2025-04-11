<?php


use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseStringHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\number\NumberControl;
use backend\models\MpLevel;
use backend\models\MpSchool;
use backend\models\MpStudent;
use backend\models\MpYear;
use backend\models\MpPay;
use backend\models\MpPayType;
use backend\models\User;

$select_level = ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
    return $model['kelas_c'];
}
);

$select_year = ArrayHelper::map(MpYear::find()->orderBy(['id' => SORT_DESC])->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['nama'];
}
);

$select_pay =   ArrayHelper::map(MpPay::find()->asArray()->all(),'id', function($model, $defaultValue) {

    $type_pay = MpPayType::findOne(['id' => $model['type_pay']]);
    return $model['name'] . ' - ' . $model['type'] . '/' . strtoupper($type_pay['name']);
}
);

$select_user = ArrayHelper::map(User::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_sekolah = ArrayHelper::map(MpSchool::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$nis = Yii::$app->request->get('nis');
$bulan = Yii::$app->request->get('bulan');
$tahun = Yii::$app->request->get('tahun');
$year = Yii::$app->request->get('year');
$school = Yii::$app->request->get('school');
$level = Yii::$app->request->get('level');

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

            <div class="change-form">

                <div class="row">

                    <div class="col-lg-12">

                        <?= DetailView::widget([
                            'model' => $model_,
                            'attributes' => [
                                
                                [
                                    'attribute' => 'nis',
                                    'label' => 'Nama Lengkap',
                                    'value' => function($data) {
                                        $mp = MpStudent::findOne(['nis' => $data['nis']]);
                                        return $mp['full_name'];
                                    }
                                ],
                                [
                                    'attribute' => 'id_tahun',
                                    'label' => 'Tahun Ajaran',
                                    'value' => function($data) {
                                        $mp = MpYear::findOne(['id' => $data['id_tahun']]);
                                        return $mp['nama'];
                                    }
                                ],
                                [
                                    'attribute' => 'id_sekolah',
                                    'label' => 'Sekolah',
                                    'value' => function($data) {
                                        $mp = MpSchool::findOne(['id' => $data['id_sekolah']]);
                                        return $mp['name'];
                                    }
                                ],
                                [
                                    'attribute' => 'id_jenjang',
                                    'label' => 'Jenjang',
                                    'value' => function($data) {
                                        $mp = MpLevel::findOne(['kelas' => $data['id_jenjang']]);
                                        return $mp['kelas_c'];
                                    }
                                ],
                                [
                                    'attribute' => 'tahun',
                                    'label' => 'Tahun',
                                    'value' => $tahun,
                                ],
                                [
                                    'attribute' => 'bulan',
                                    'label' => 'Bulan',
                                    'value' => function($data) {

                                        $bulan = [
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
                                        ];

                                        return $bulan[$data['bulan']];

                                    },
                                ],
                            ],

                        ]) ?>

                    </div>

                </div>

                <?php Pjax::begin([
                    'id' => 'pjax-listing-form',
                    'enablePushState' => false,
                    'enableReplaceState' => true,
                    'timeout' => false,
                ]) ?> 

                <?php $form = ActiveForm::begin([
                    'id' => 'listing-form', 
                    'options' => ['data' => ['pjax' => true]]
                ]); ?>

            	<div class="row">

            		<div class="col-lg-4">

            		    <?= $form->field($model, 'id_pay')->widget(Select2::classname(),[
            		        'data' => $select_pay,
            		        'options' => [
            		            'placeholder' => 'Pilih Pembayaran',
            		            'value' => $model->isNewRecord ? 0 : $model->id_pay,
                                'onChange' => '$.post("'.Url::base().'/reff/pay?id='.'" + $(this).val(), function(data) {
                                        what = JSON.parse(data);
                                        $("#mppaylist-type").val(what.type).trigger("change");
                                    }
                                );',
            		        ],
            		        'pluginOptions' => [
            		            'allowClear' => false
            		            ],
            		        ]);
            		    ?>

            			<?= $form->field($model, 'nis')->hiddenInput(['value' => $nis])->label(false) ?>
            			<?= $form->field($model, 'bulan')->hiddenInput(['value' => $bulan])->label(false) ?>
            			<?= $form->field($model, 'tahun')->hiddenInput(['value' => $tahun])->label(false) ?>
            			<?= $form->field($model, 'id_tahun')->hiddenInput(['value' => $year])->label(false) ?>
            			<?= $form->field($model, 'id_sekolah')->hiddenInput(['value' => $school])->label(false) ?>
                        <?= $form->field($model, 'id_jenjang')->hiddenInput(['value' => $level])->label(false) ?>
                        
            		</div>

            		<div class="col-lg-3">

                        <?= $form->field($model, 'type')->widget(Select2::classname(),[
                            'data' => ['P' => 'PERCENT', 'N' => 'NOMINAL'],
                            'options' => [
                                'placeholder' => 'Pilih Pembayaran',
                                'value' => $model->isNewRecord ? 'P' : $model->type,
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                                ],
                            ]);
                        ?>

            		</div>

            		<div class="col-lg-2">

                        <?= $form->field($model, 'value')->widget(NumberControl::classname(), [
                            'data' => 'number-decimal',
                            'maskedInputOptions' => [
                                'digits' => 0,
                                'alias' => 'numeric',
                                'groupSeparator' => '.',
                                'autoGroup' => true,
                                'autoUnmask' => true,
                                'unmaskAsNumber' => true,
                            ],
                        ]); ?>

            		</div>

                    <div class="col-lg-3">

                        <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>

                    </div>

            	</div>

            	<div class="row">

            		<div class="col-md-12 col-md-offset-4 text-center">

            		    <div class="form-group">
            		        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            		    </div>

            		    <div id="pjax-message"><?= $message ?></div>

            		</div>

            	</div>

                <?php ActiveForm::end(); ?>

            	<div class="row" style="margin-bottom:25px">

            	    <div class="col-lg-12">

            	    	<div class="table-responsive table-nowrap">

            				<?php /*Pjax::begin([
            		            'id' => 'pjax-change-grid',
            		            'enablePushState' => false,
            		            // 'enableReplaceState' => true,
            		            'timeout' => false,
            		        ])*/ ?> 

            				<?= GridView::widget([
            	            	'id' => 'index-change-grid',
            			        'dataProvider' => $dataProvider,
            			        'filterModel' => $searchModel,
            			        'columns' => [

                            			['class' => 'yii\grid\SerialColumn'],

										// 'id',
										// 'nis',
										// 'id_tahun',
										// 'id_sekolah',
										// 'id_jenjang',
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
                                            'filter' => [ 'P' => 'PERCENT', 'N' => 'NOMINAL' ],
                                            'value' => function ($data) {
                                                $type = [ 'P' => 'PERCENT', 'N' => 'NOMINAL' ];
                                                return $type[$data['type']];
                                            },
                                        ],
                                        [
                                            'attribute' => 'value',
                                            'format' => 'raw',
                                            'value' => function ($model) {

                                                if ($model->type == 'P') {
                                                    return $model->value . ' <b>%</b>';
                                                } else if ($model->type == 'N') {
                                                    return '<b>Rp. </b>' . number_format($model->value, 0, ",", ".");
                                                }
                                            },
                                            'headerOptions' => ['style' => 'text-align:center;'],
                                            'contentOptions' => ['style' => 'text-align:left;'],
                                        ],
										'reason',
										// 'id_user',
										// 'timestamp',
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
                                                        'class' => 'pjax-delete-link2',
                                                        'delete-url' => $url,
                                                        'pjax-container' => 'pjax-listing-form',
                                                        // 'data' => ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 1],
                                                    ]);
                                                }
                                            ]
                                        ],
            			        	],
            			    ]) ?>

            			    <?php //Pjax::end() ?>

            			</div>

            		</div>

            	</div>

                <?php Pjax::end() ?>

            </div>
        </div>
    </div>
</div>

<?php

$js = <<< JS


$(document).ready(function() {

    $('.pjax-delete-link2').on('click', function(e) {
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
                    // $.pjax.reload('#pjax-listing-index', {timeout: false});
                });
            }
        })
    });

    $(document).on('pjax:success', function(e) {

        $('.pjax-delete-link2').on('click', function(e) {
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
                        // $.pjax.reload('#pjax-listing-index', {timeout: false});
                    });
                }
            })
        });

    });

    // Fix The Problems of Universe
    // $(document).on('submit', '#listing-form', function(e) {
    //     e.preventDefault();
    //     return false;
    // });

});

/*$('document').ready(function(){ 

	var number = $('#shipmentlog-number').val();
	$('#shipmentlog-number').focus().val('').val(number);
	$('#shipmentlog-number').on('click', function(e){
		$(this).select();
	});

	$(document).on('pjax:start', '#pjax-listing-form', function(e) {
	    e.preventDefault();
	    console.log('Start 3');
	    $('#pjax-message').text('Loading ...');
	});

	$(document).on('pjax:end', '#pjax-listing-form', function(e) {
	    e.preventDefault();
	    console.log('End 3');
	    var number = $('#shipmentlog-number').val();
		$('#shipmentlog-number').focus().val('').val(number);
		$('#shipmentlog-number').on('click', function(e){
			$(this).select();
		});
	});

	$('#pjax-listing-form').on('pjax:start', function(e) {
		e.preventDefault();
	    console.log('Start 4');
	    $('#pjax-message').text('Loading ...');
	});

	$('#pjax-listing-form').on('pjax:end', function(e) {
		e.preventDefault();
	    console.log('End 4');
	});

    // Fix The Problems of Universe
    $(document).on('submit', '#change-form', function(e) {
        e.preventDefault();
        return false;
    });

});*/

JS;

$this->registerJs($js);