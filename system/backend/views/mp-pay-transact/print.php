<?php

use yii\helpers\Url;
use yii\helpers\Html;


$this->title = 'Print Kwitansi';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Pembayaran Siswa', 'url' => ['input']];
$this->params['breadcrumbs'][] = $this->title;

$logo = '../dist/img/i.png';
$website = '';

/*echo Yii::$app->request->BaseUrl;
echo '<br>';
echo Url::base();
echo '<br>';
echo Url::base(false);
echo '<br>';
echo Url::home();
echo '<br>';
echo Url::home(false);
echo '<br>';
echo Yii::getAlias('@web');
echo '<br>';
echo Yii::getAlias('@webroot');*/

$number = Yii::$app->request->get('no');

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

		    <p>
		        <button class="btn btn-warning" onclick="window.print()">Print</button>
		    </p>

	    	<script>function display_logo() {
				var checkBox = document.getElementById("dlogo");
				var text = document.getElementById("logo");
				if (checkBox.checked == true){
					text.style.display = "block";
				} else {
					text.style.display = "none";
				}
			}</script>

	    	<div class="checkbox">
				<label>
					<input type="checkbox" class="styled" id="dlogo" onclick="display_logo()">
					Display Logo
				</label>
			</div>

		    <div class="print_wrapper">
			    
			    <div id="print_area">

			    	<div class="row">

			    		<div class="col-lg-12">

			    			<div class="kwitansi">

				    			<div id="logo" style="display: none; position: absolute;">
									<?=  Html::img($logo, ['width' => '50', 'height' => '']) ?>
									<br><center><b><?=$website?></b></center>
					    		</div>

								<div style="text-align:center"><b>PERGURUAN MUHAMMADIYAH MATRAMAN</b></div>
								<div style="text-align:center"><b>KWITANSI PEMBAYARAN</b></div>

					    		<?php

					    			$mptransact = \backend\models\MpPayTransact::findOne(['no' => $number]);
					    			$mpsudent   = \backend\models\MpStudent::findOne(['nis' => $mptransact['nis']]);
					    			$mpyear     = \backend\models\MpYear::findOne(['id' => $mptransact['id_tahun']]);
					    			$mpschool   = \backend\models\MpSchool::findOne(['id' => $mptransact['id_sekolah']]);
					    			$mplevel    = \backend\models\MpLevel::findOne(['kelas' => $mptransact['id_jenjang']]);
					    			
					    			$name    = $mpsudent['full_name'];
					    			$sekolah = $mpschool['name'];
					    			$jenjang = $mplevel['kelas'] . ' ' . $mplevel['type'];				    			
					    			$ajaran  = $mpyear['nama'];
					    			$tahun   = $mptransact['tahun'];
					    			$bulan   = [1 => 'JANUARI', 
									            2 => 'FEBRUARI', 
									            3 => 'MARET', 
									            4 => 'APRIL', 
									            5 => 'MEI', 
									            6 => 'JUNI', 
									            7 => 'JULI', 
									            8 => 'AGUSTUS', 
									            9 => 'SEPTEMBER', 
									            10 => 'OKTOBER', 
									            11 => 'NOVEMBER', 
									            12 => 'DESEMBER'
												];

					    			$tanggal_ = explode(" ", $mptransact['datetime']);
					    			$tanggal  = explode("-", $tanggal_[0]);
					    			$ftanggal = $tanggal[2] . ' ' . $bulan[abs($tanggal[1])] . ' ' . $tanggal[0];



									if ($number)
	                                {
	                                	$transact = \backend\models\MpPayTransact::find()->where(['no' => $number])->orderBy(['id_pay' => SORT_ASC])->asArray()->all();
										
										// $departure_kg = \backend\models\ShipmentDepartureDetail::find()->where(['departure_number' => $number])->sum('awb_kg');
										// $departure_colly = \backend\models\ShipmentDepartureDetail::find()->where(['departure_number' => $number])->sum('awb_colly');

										if (count($transact) > 0) {

											$nominal = 0;

											foreach ($transact as $key => $value) {

												$nominal = $nominal + $value['nominal'];

											}
										}
									}

								?>

								<div style="display: inline-block; margin: 0; width:100%">

									<div style="float:left; width: 40%">

						    			<div class="table-nowrap" style="margin-top: 10px; margin-bottom: 10px">
				                    
					                        <table class="table">

					                            <tbody>

					                            	<tr>

					                            		<td>No Kwitansi</td>
					                            		<td>:</td>
					                            		<td><?=$number?></td>

					                            	</tr>

					                            	<tr>

					                            		<td>Sudah Terima</td>
					                            		<td>:</td>
					                            		<td><?=$mpsudent['full_name']?></td>

					                            	</tr>

					                            	<tr>

					                            		<td>Banyaknya Uang</td>
					                            		<td>:</td>
					                            		<td><?=number_format($nominal)?></td>

					                            	</tr>

					                            	<tr>

					                            		<td>Terbilang</td>
					                            		<td>:</td>
					                            		<td><?= ucwords(\backend\controllers\MpPayTransactController::terbilang($nominal)) ?></td>

					                            	</tr>

					                            	<tr>

					                            		<td>Bulan</td>
					                            		<td>:</td>
					                            		<td><?=$bulan[$mptransact['bulan']] . ' - ' . $tahun ?></td>

					                            	</tr>

					                            	<tr>

					                            		<td>Kelas</td>
					                            		<td>:</td>
					                            		<td><?=$sekolah . ' - ' . $jenjang ?></td>

					                            	</tr>

					                            	<tr>

					                            		<td>Tahun Ajaran</td>
					                            		<td>:</td>
					                            		<td><?=$ajaran?></td>

					                            	</tr>

					                            	<tr>

					                            		<td>Tanggal Bayar</td>
					                            		<td>:</td>
					                            		<td><?=$ftanggal?></td>

					                            	</tr>

					                            </tbody>

					                        </table>

					                    </div>

									</div>

									<div style="float:left; width: 10%">

									</div>

									<div style="float:right; width: 50%">

						    			<div class="table-nowrap" style="margin-top: 10px; margin-bottom: 10px">
				                    
					                        <table class="table table-number">

					                            <thead>

					                                <tr>
					                                    <th width="1">No</th>
					                                    <th width="150">Keterangan</th>
					                                    <th width="150">Jumlah</th>
					                                    <th width="150">Diskon</th>
					                                    <th width="50">Dibayar</th>
					                                </tr>

					                            </thead>

					                            <tbody id="table-bagging">

					                                <?php 
																
														$tunggakan = 0;

														if ($number)
					                                    {
					                                    	$transact = \backend\models\MpPayTransact::find()->where(['no' => $number])->orderBy(['id_pay' => SORT_ASC])->asArray()->all();
					                                    	// $transact = \backend\models\MpPayTransact::find()->where(['bulan' => $bulan, 'tahun' => $tahun, 'nis' => $mptransact['nis']])->orderBy(['id_pay' => SORT_ASC])->asArray()->all();
															
															// $departure_kg = \backend\models\ShipmentDepartureDetail::find()->where(['departure_number' => $number])->sum('awb_kg');
															// $departure_colly = \backend\models\ShipmentDepartureDetail::find()->where(['departure_number' => $number])->sum('awb_colly');

															if (count($transact) > 0) {

																$jumlah = 0;
																$diskon = 0;
																$nominal = 0;

																foreach ($transact as $key => $value) {

																	$pay = \backend\models\MpPay::findOne(['id' => $value['id_pay']]);

																	echo '<tr>';
																	echo '<td></td>';
																	echo '<td>' . $pay['name'] . '</td>';
																	echo '<td>' . number_format($value['id_paylist']) . '</td>';
																	echo '<td>' . number_format($value['disc_value']) . '</td>';
																	echo '<td>' . number_format($value['nominal']) . '</td>';
																	echo '</tr>';

																	$jumlah = $jumlah + $value['id_paylist'];
																	$diskon = $diskon + $value['disc_value'];
																	$nominal = $nominal + $value['nominal'];

																}

																$nominalx = \backend\models\MpPayTransact::find()->where(['bulan' => $mptransact['bulan'], 'tahun' => $mptransact['tahun'], 'nis' => $mptransact['nis']])->sum('nominal');

																$tunggakan = ($jumlah - $diskon) - $nominalx;

															}
														}
					                                ?>

					                            </tbody>

					                            <tfoot>

					                                <tr>
					                                    <th colspan="2" style="text-align: center">TOTAL</th>
					                                    <th colspan="2"></th>
					                                    <th colspan="1">Rp. <?=number_format($nominal)?></th>
					                                </tr>    
					                            </tfoot>

					                        </table>

					                    </div>

					                    Sisa Pembayaran : <?=$tunggakan == 0 ? 'LUNAS' : 'Rp. ' . number_format($tunggakan)?>

									</div>

								</div>

								<div style="clear: both;"></div>


			                    <div class="table-responsive table-nowrap" style="margin:0">
			                        <table class="">
			                            <thead>
			                                <tr>
			                                    <th style="text-align: left" width="100">Note :</th>
			                                    <th style="text-align: left" width="150"></th>
			                                    <th style="text-align: left" width="250"></th>
			                                    <th style="text-align: left" width="200">Paraf</th>
			                                </tr>
			                            </thead>
			                            <tbody id="table-info-bagging">
			                            	<tr>
			                            		<td>&nbsp;</td>
			                            		<td>&nbsp;</td>
			                            		<td></td>
			                            		<td>&nbsp;</td>
			                            	</tr>
			                            	<tr>
			                            		<td>Dicetak Pada <?=date('d-m-Y H:i:s')?></td>
			                            		<td>&nbsp;</td>
			                            		<td></td>
												<td><?=Yii::$app->user->identity->name?></td>
			                            	</tr>
			                            </tbody>
			                        </table>

			                    </div>

			                </div>

			    		</div>

			    	</div>

			    </div>

			</div>

		</div>

	</div>

</div>

<?php

$js = <<< JS

function print(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var destalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = destalContents;
}

JS;

$css = <<< CSS

@media print {

	html, 
	body,
	p,
	.wrapper, 
	.card-header {
		visibility: hidden;
		position: absolute;
		margin: 0px;
		padding: 0px;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		font-family: "Calibri";

	}

	.content,
	.content-wrapper,
	.print_wrapper, 
	.card-body  {
		margin: 0px !important;
		padding: 0px !important;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;

	}

	.checkbox {
		display: none
	}

	#print_area {
		visibility: visible;
	}
}

.print_wrapper {
	width: 100%;
	height: 100%;
	padding: 15px;
	margin: auto auto 25px;
	border: 1px solid #ddd;
	-webkit-box-shadow: 5px 5px 20px 1px rgba(0,0,0,0.1);
	-moz-box-shadow: 5px 5px 20px 1px rgba(0,0,0,0.1);
	box-shadow: 5px 5px 20px 1px rgba(0,0,0,0.1);
	background: #fff !important;
}

.print_wrapper .kwitansi {

	margin: 0px;
	padding: 0px;
	height: 350px;
	/*height: 340px;*/ /* A4 */
	/*height: 320px;*/ /* Letter */
	/*height: 302px;*/ /* Legal */
	/*border:1px solid #FFF;*/

}

td, th
{
	padding: 4px
}

th {
	/* text-align: center; */
}

.table > thead > tr > th, 
.table > tbody > tr > th, 
.table > tfoot > tr > th, 
.table > thead > tr > td, 
.table > tbody > tr > td, 
.table > tfoot > tr > td {

	font-size: 18px;
	line-height: 18px;
	padding: 1px
}

h3 {
	margin-top: 10px;
}

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

.table td, .table th, .table thead th {
    border: none;
}

CSS;

$this->registerJs($js);
$this->registerCss($css);

?>
