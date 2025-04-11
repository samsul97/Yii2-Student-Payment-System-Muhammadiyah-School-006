<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use backend\models\MpLevel;
use backend\models\MpClass;
use backend\models\MpPay;
use backend\models\MpPayList;
use backend\models\MpYear;
use backend\models\MpStudent;
use backend\models\MpSchool;

$value_student = null;
$init_student  = empty($value_student) ? null : $value_student;
$url_student   = Url::to(['reff/students']);

$select_level = ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
        return $model['type'] . ' - ' . $model['kelas_c'];
    }
);

$select_class = ArrayHelper::map(MpClass::find()->asArray()->all(),'id', function($model, $defaultValue) {
        return $model['name'];
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

$select_school = ArrayHelper::map(MpSchool::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
});

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpPayTransactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Input Kenaikan Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Kenaikan Kelas', 'url' => ['index']];
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

            <div class="mp-pay-grade-form">

                <div class="row">

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
                            <?= Html::label('Ruang', 'class', ['class' => 'control-label']) ?>
                            <?= Select2::widget(['id' => 'class',
                                'name' => 'class',
                                'data' => $select_class,
                                'value' => 0,
                                'options' => [
                                    'placeholder' => 'Pilih ...',
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
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
                                    'allowClear' => true
                                ],
                            ]) ?>
                            
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12 col-md-offset-4 text-center">

                        <div class="form-group">
                            <?= Html::a('Search', ['grade'], ['class' => 'btn btn-success search']) ?>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-3">

                        <div class="form-group">
                            <?= Html::label('Status', 'status', ['class' => 'control-label']) ?>
                            <?= Select2::widget(['id' => 'status',
                                'name' => 'status',
                                'data' => ['LULUS' => 'LULUS', 'TIDAK LULUS' => 'TIDAK LULUS'],
                                'value' => 'LULUS',
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
                            <?= Html::label('Tanggal', 'date', ['class' => 'control-label']) ?>
						    <?= DatePicker::widget([
								'id' => 'date',
								'name' => 'date',
								'removeButton' => false,
								'value' => date('Y-m-d'),
								'options' => ['placeholder' => 'Date Time'],
								'pluginOptions' => [
									'autoclose'=>true,
									'format' => 'yyyy-mm-dd'
							   ]
							]) ?>
                            
                        </div>

                    </div>

                    <div class="col-lg-3">

                        <div class="form-group">
                            <?= Html::label('&nbsp;', 'upgrade', ['class' => 'control-label']) ?>
                            <div class="button-group">
                                <?= Html::a('Upgrade', ['upgrade'], ['class' => 'btn btn-primary upgrade']) ?>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">

                	<div class="table-responsive table-nowrap table-number">

	                	<form id="grade">
		                	
		                	<table class="table table-bordered table-grade">

		                		<thead>
		                			
		                			<tr>
		                				<th size="10">No</th>
		                				<th>Nis</th>
		                				<th>Nama</th>
		                				<th>Sekolah</th>
		                				<th>Jenjang</th>
		                				<th>Ruang</th>
		                				<th>Tahun</th>
		                				<th>Action</th>
		                			</tr>

		                		</thead>

		                		<tbody id="table-grade">

		                		</tbody>

		                		<tfoot>
		                			
		                			<tr>
		                				<td colspan="7"></td>
		                				<td></td>
		                			</tr>

		                		</tfoot>

		                	</table>

		                </form>
                	
                	</div>

                </div>

            </div>

        </div>

    </div>

</div>


<?php

$url_grade_search = Url::base().'/reff/grade-search?school=';
$url_grade_upgrade = Url::base().'/reff/grade-upgrade';

$js = <<< JS


const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000,
	background: '#EEEEEE'
});

$('.search').on('click', function(e) {

	e.preventDefault();

	$('#table-grade').html('');

	school = $('#school').val();
	level  = $('#level').val();
	classx = $('#class').val();
	year   = $('#year').val();

	$.post('$url_grade_search' + school + '&level=' + level + '&class=' + classx + '&year=' + year, function(data) {

		what = JSON.parse(data);

		 if (what.status) {

		 	$.each(what.student, function(k,v){

			 	$('#table-grade').append(

					'<tr>' +
					'<td></td>' +
					'<td class="nis"><input type="hidden" name="nis[]" class="nis" value="' + v.nis + '" />' + v.nis + '</td>' +
					'<td>' + v.full_name + '</td>' +
					'<td>' + v.sekolah + '</td>' +
					'<td>' + v.jenjang + '</td>' +
					'<td>' + v.ruang + '</td>' +
					'<td>' + v.tahun + '</td>' +
					'<td align="center"><button class="btn btn-danger search-delete" tabindex="-1"><i class="fa fa-trash"></i></button></td>' +
					'</tr>'

				);

		 	});

			Toast.fire({
				icon: 'success',
				title: what.message,
			});


		} else {

			Toast.fire({
				icon: 'error',
				title: what.message,
			});

		}

	});

});

$('.upgrade').on('click', function(e) {

	e.preventDefault();

	school = $('#school').val();
	level  = $('#level').val();
	classx = $('#class').val();
	year   = $('#year').val();
	date   = $('#date').val();
	status = $('#status').val();
	nis    = $('#grade').serialize();

	if (nis) {

		if (school && level && classx && year && date && status) {

			$.post({
		        url: '$url_grade_upgrade',
		        data: {
		            school: school,
		            level: level,
		            class: classx,
		            year: year,
		            date: date,
		            status: status,
		            nis: nis,
		            _csrf: yii.getCsrfToken()
		        },
		        statusCode: {

				    403: function() {
				    	
				    	Toast.fire({
							icon: 'error',
							title: 'Forbidden',
						});
				       
				    }
				},
		        success: function(data) {

					what = JSON.parse(data);

					Toast.fire({
						icon: what.status ? 'success' : 'error',
						title: what.message,
					});
		        },
		        error: function(err) {
		        	console.log(err);
		        }
		    });

		} else {

			Toast.fire({
				icon: 'error',
				title: 'Lengkapi Field',
			});
		}

	} else {

		Toast.fire({
			icon: 'error',
			title: 'No Data',
		});

	}

});

$(document).on('click', '.search-delete', function(e) {
	
	e.preventDefault();
	
	id =  $(this).closest('tr').find('.id').val();

	if (id) {

		Toast.fire({
			icon: id ? 'success' : 'error',
			title: id ? 'Data Deleted' : 'Data not found',
		});
	}

	$(this).closest('tr').remove();
	$('#table-grade').find('tr').removeClass('last');
	$('#table-grade').find('tr').last().addClass('last');
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