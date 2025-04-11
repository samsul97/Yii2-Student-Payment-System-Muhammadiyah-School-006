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

$this->title = 'Laporan Penunggakan Siswa';
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

            <div class="mp-pay-remission-form">

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

                </div>

                <div class="row">

                    <div class="col-md-12 col-md-offset-4 text-center">

                        <div class="form-group">
                            <?= Html::a('Search', ['remission'], ['class' => 'btn btn-success search']) ?>
                        </div>

                    </div>

                </div>

                <div class="row">

                	<div class="table-responsive table-nowrap table-number">

	                	<form id="remission">
		                	
		                	<table class="table table-bordered table-remission">

		                		<thead>
		                			
		                			<tr>
		                				<th size="10">No</th>
		                				<th>Nis</th>
		                				<th>Nama</th>
		                				<th>Sekolah</th>
		                				<th>Jenjang</th>
		                				<th>Tagihan</th>
		                				<th>Diskon</th>
		                				<th>Dibayar</th>
		                				<th>Tunggakan</th>
		                				<th>Status</th>
		                			</tr>

		                		</thead>

		                		<tbody id="table-remission">

		                		</tbody>

		                		<tfoot>
		                			
		                			<tr>
		                				<td colspan="9"></td>
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

$url_remission_search = Url::base().'/reff/remission-search?school=';

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

	$('#table-remission').html('');

	school = $('#school').val();
	level  = $('#level').val();
	year   = $('#year').val();
	tahun  = $('#tahun').val();
	bulan  = $('#bulan').val();

	$.post('$url_remission_search' + school + '&level=' + level + '&year=' + year + '&tahun=' + tahun + '&bulan=' + bulan, function(data) {

		what = JSON.parse(data);

		 if (what.status) {

		 	$.each(what.student, function(k,v){

		 		kredit = v.transact !== 0 ? 'KREDIT' : 'BELUM LUNAS';
		 		status = v.invoice === v.transact ? 'LUNAS' : kredit;

			 	$('#table-remission').append(

					'<tr>' +
					'<td></td>' +
					'<td class="nis"><input type="hidden" name="nis[]" class="nis" value="' + v.nis + '" />' + v.nis + '</td>' +
					'<td>' + v.full_name + '</td>' +
					'<td>' + v.sekolah + '</td>' +
					'<td>' + v.jenjang + '</td>' +
					'<td>' + numberWithCommas(v.invoice) + '</td>' +
					'<td>' + numberWithCommas(v.remission) + '</td>' +
					'<td>' + numberWithCommas(v.transact) + '</td>' +
					'<td>' + numberWithCommas(v.credit)  + '</td>' +
					'<td>' + status + '</td>' +
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
	$('#table-remission').find('tr').removeClass('last');
	$('#table-remission').find('tr').last().addClass('last');
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

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