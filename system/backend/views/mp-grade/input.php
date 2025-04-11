<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use backend\models\MpLevel;
use backend\models\MpPay;
use backend\models\MpPayList;
use backend\models\MpYear;
use backend\models\MpClass;
use backend\models\MpStudent;
use backend\models\MpSchool;

$value_student = null;
$init_student  = empty($value_student) ? null : $value_student;
$url_student   = Url::to(['reff/students']);

$select_level = ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
        return $model['type'] . ' - ' . $model['kelas_c'];
    }
);

$select_year = ArrayHelper::map(MpYear::find()->orderBy(['id' => SORT_DESC])->asArray()->all(),'id', function($model, $defaultValue) {
        return $model['nama'];
    }
);

$select_class = ArrayHelper::map(MpClass::find()->asArray()->all(),'id', function($model, $defaultValue) {
        return $model['name'];
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

$this->title = 'Update Kenaikan Kelas';
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
                                        if (result.ruangan) {
                                            $("#class").val(result.ruangan).trigger("change"); 
                                        }
                                        if (result.nama) {
                                            $("#name").val(result.nama); 
                                        }
                                        return result.text; 
                                     }'),
                                ],
                            ]) ?>
                            <?= Html::hiddenInput('name', null, ['id' => 'name']) ?>
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
                            <?= Html::label('Ruang', 'class', ['class' => 'control-label']) ?>
                            <?= Select2::widget(['id' => 'class',
                                'name' => 'class',
                                'data' => $select_class,
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
                            <?= Html::label('&nbsp;', 'level', ['class' => 'control-label']) ?>
                            <div class="button-group">
                                <?= Html::a('Update', ['input'], ['class' => 'btn btn-success update']) ?>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">

                	<div class="table-responsive table-nowrap table-number">
                	
	                	<table class="table table-bordered">

	                		<thead>
	                			
	                			<tr>
	                				<th>No</th>
	                				<th>Nis</th>
	                				<th>Nama</th>
	                				<th>Tahun Ajaran</th>
	                				<th>Sekolah</th>
	                				<th>Jenjang</th>
	                				<th>Kelas</th>
	                				<th>Status</th>
	                				<th>Tanggal</th>
	                				<th>Action</th>
	                			</tr>

	                		</thead>

	                		<tbody id="table-grade">

	                		</tbody>

	                		<tfoot>
	                			
	                			<tr>
	                				<td colspan="9"></td>
	                				<td></td>
	                			</tr>

	                		</tfoot>

	                	</table>
                	
                	</div>

                </div>

            </div>

        </div>

    </div>

</div>


<?php

$url_grade_crate = Url::base().'/reff/grade-create?nis=';
$url_grade_delete = Url::base().'/reff/grade-delete?id=';

$js = <<< JS


const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000,
	background: '#EEEEEE'
});

$('.update').on('click', function(e) {

	e.preventDefault();

	nis    = $('#nis').val();
	name   = $('#name').val();
	year   = $('#year').val();
	school = $('#school').val();
	level  = $('#level').val();
	classx = $('#class').val();
	status = $('#status').val();
	date   = $('#date').val();

	flag = true;

	$('.nis').each(function(k, v) {

        status_ = $(this).closest('tr').find('.status').text();
        school_ = $(this).closest('tr').find('.school').val();
        level_ = $(this).closest('tr').find('.level').val();
        class_ = $(this).closest('tr').find('.class').val();
        year_ = $(this).closest('tr').find('.year').val();

		if (nis === $(this).text() && status === status_ && school === school_ && level === level_ && classx === class_ && year === year_) {

			Toast.fire({
				icon: 'error',
				title: 'List Sudah Ada (' + name + '/' + status + ')',
			});

			flag = false;
		}

	});

	if (flag) {

		$.post('$url_grade_crate' + nis + '&year=' + year + '&school=' + school + '&level=' + level + '&class=' + classx + '&status=' + status + '&date=' + date, function(data) {

			what = JSON.parse(data);

			 if (what.status) {

			 	$('#table-grade').append(

					'<tr>' +
					'<td><input type="hidden" class="id" value="' + what.id + '" /></td>' +
					'<td class="nis">' + nis + '</td>' +
					'<td>' + name + '</td>' +
					'<td><input type="hidden" class="year" value="' + what.year.id + '" />' + what.year.nama +  '</td>' +
					'<td><input type="hidden" class="school" value="' + what.school.id + '" />' + what.school.name + '</td>' +
					'<td><input type="hidden" class="level" value="' + what.level.kelas + '" />' + what.level.type + ' - ' + what.level.kelas_c + '</td>' +
					'<td><input type="hidden" class="class" value="' + what.class.id + '" />' + what.class.name + '</td>' +
					'<td class="status">' + status + '</td>' +
					'<td>' + date + '</td>' +
					'<td align="center"><button class="btn btn-danger update-delete" tabindex="-1"><i class="fa fa-trash"></i></button></td>' +
					'</tr>'

				);

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

	}

});

$(document).on('click', '.update-delete', function(e) {
	e.preventDefault();
	id =  $(this).closest('tr').find('.id').val();
	if (id) {

		$.post('$url_grade_delete' + id, function(data) {

			what = JSON.parse(data);

			Toast.fire({
				icon: what.status ? 'success' : 'error',
				title: what.message,
			});

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