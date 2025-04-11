<?php

use yii\helpers\Url;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use backend\models\MpPayList;
use backend\models\MpPayRemission;
use backend\models\MpPayTransact;
use backend\models\MpStudent;
use backend\models\MpTeacher;
use backend\models\MpGrade;
use backend\models\MpLevel;
use backend\models\MpPay;
use backend\models\MpPayRegister;
use backend\models\MpPayType;
use backend\models\MpTeacherPayroll;
use backend\models\MpTeacherPosition;
use backend\models\MpTeacherStatus;
use backend\models\MpYear;
use backend\models\User;

/* @var $this yii\web\View */

$this->title = 'Sistem Informasi Sekolah Muhammadiyah';
$this->params['page_title'] = 'Dashboard';
$this->params['page_desc'] = $this->title;
$this->params['title_card'] = 'Information';

?>
<!-- Default box -->
<div class="card">
   <div class="card-header">
      <h3 class="card-title"><?=Html::encode($this->title) ?></h3>
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
      <div class="site-index">
         <div class="row" style="margin: 3px;">
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-yellow">
                  <div class="inner">
                     <p>Tingkatan Kelas</p>
                     <h3><?=Yii::$app->formatter->asInteger(MpGrade::getCount()); ?></h3>
                  </div>
                  <div class="icon">
                     <i class="fa fa-long-arrow-alt-up"></i>
                  </div>
                  <a href="<?=Url::to(['mp-grade/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-blue">
                  <div class="inner">
                     <p>Daftar Transaksi</p>
                     <h3><?=Yii::$app->formatter->asInteger(MpPayList::getCount()); ?></h3>
                  </div>
                  <div class="icon">
                     <i class="fa fa-list"></i>
                  </div>
                  <a href="<?=Url::to(['mp-pay-list/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-gradient-gray">
                  <div class="inner">
                     <p>Daftar Pembayaran</p>
                     <h3><?=Yii::$app->formatter->asInteger(MpPayRemission::getCount()); ?></h3>
                  </div>
                  <div class="icon">
                     <i class="fa fa-wrench"></i>
                  </div>
                  <a href="<?=Url::to(['mp-pay-remission/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-teal">
                  <div class="inner">
                     <p>Transaksi Pembayaran</p>
                     <h3><?=Yii::$app->formatter->asInteger(MpPayTransact::getCount()); ?></h3>
                  </div>
                  <div class="icon">
                     <i class="fa fa-exchange-alt"></i>
                  </div>
                  <a href="<?=Url::to(['mp-pay-transact/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
         </div>
         <div class="row" style="margin: 3px;">
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-blue">
                  <div class="inner">
                     <h3><?=Yii::$app->formatter->asInteger(MpTeacher::getCount()); ?></h3>
                     <p>Guru</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-graduation-cap"></i>
                  </div>
                  <a href="<?=Url::to(['mp-teacher/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-green">
                  <div class="inner">
                     <h3><?=Yii::$app->formatter->asInteger(MpStudent::getCount()); ?><sup style="font-size: 20px"></sup></h3>
                     <p>Siswa</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-user-graduate"></i>
                  </div>
                  <a href="<?=Url::to(['mp-student/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-orange">
                  <div class="inner">
                     <h3><?=Yii::$app->formatter->asInteger(MpPayRegister::getCount()); ?></h3>
                     <p>Transaksi Pendaftaran</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-book"></i>
                  </div>
                  <a href="<?=Url::to(['mp-pay-register/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-red">
                  <div class="inner">
                     <h3><?=Yii::$app->formatter->asInteger(User::getCount()); ?></h3>
                     <p>Users</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-users"></i>
                  </div>
                  <a href="<?=Url::to(['mp-pay-type/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
         </div>
         <div class="row" style="margin: 3px;">
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-purple">
                  <div class="inner">
                     <p>Tipe Pembayaran</p>
                     <h3><?=Yii::$app->formatter->asInteger(MpPay::getCount()); ?></h3>
                  </div>
                  <div class="icon">
                     <i class="fa fa-money-bill"></i>
                  </div>
                  <a href="<?=Url::to(['mp-grade/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-gray">
                  <div class="inner">
                     <p>Tingkat Kelas</p>
                     <h3><?=Yii::$app->formatter->asInteger(MpLevel::getCount()); ?></h3>
                  </div>
                  <div class="icon">
                     <i class="fa fa-level-up-alt"></i>
                  </div>
                  <a href="<?=Url::to(['mp-pay-list/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-olive">
                  <div class="inner">
                     <p>Jenis Pembayaran</p>
                     <h3><?=Yii::$app->formatter->asInteger(MpPayType::getCount()); ?></h3>
                  </div>
                  <div class="icon">
                     <i class="fa fa-adjust"></i>
                  </div>
                  <a href="<?=Url::to(['mp-pay-remission/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-xs-6">
               <!-- small box -->
               <div class="small-box bg-warning">
                  <div class="inner">
                     <p>Tahun Ajaran</p>
                     <h3><?=Yii::$app->formatter->asInteger(MpYear::getCount()); ?></h3>
                  </div>
                  <div class="icon">
                     <i class="fa fa-calendar-times"></i>
                  </div>
                  <a href="<?=Url::to(['mp-pay-transact/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-6">
            <div class="box-header with-border">
               <!-- <h3 class="box-title">Guru Berdasarkan Gaji</h3> -->
            </div>
            <div class="box-body">
               <?=Highcharts::widget([
                    'options' => [
                        'credits' => false, 
                        'title' => [
                            'text' => 'Gaji Guru'
                        ], 
                        'exporting' => [
                            'enabled' => true
                        ], 
                        'plotOptions' => [
                            'pie' => [
                                'cursor' => 'pointer', 
                            ], 
                        ], 
                        'series' => [
                            [
                                'type' => 'pie', 
                                'name' => 'Gaji', 
                                'data' => MpTeacherPayroll::getGrafikList(), 
                            ], 
                        ], 
                    ], 

                ]) ?>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="box-header with-border">
               <!-- <h3 class="box-title">Guru Berdasarkan Status</h3> -->
            </div>
            <div class="box-body">
               <?=Highcharts::widget([
                    'options' => [
                        'credits' => false, 
                        'title' => [
                            'text' => 'Status Guru'
                        ], 
                        'exporting' => [
                            'enabled' => true
                        ], 
                        'plotOptions' => [
                            'pie' => [
                                'cursor' => 'pointer', 
                            ], 
                        ], 
                        'series' => [
                            [
                                'type' => 'pie', 
                                'name' => 'Status', 
                                'data' => MpTeacherStatus::getGrafikList(), 
                            ], 
                        ], 
                    ], 
                ]) ?>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-6">
            <div class="box-header with-border">
               <!-- <h3 class="box-title">Guru Berdasarkan Jabatan</h3> -->
            </div>
            <div class="box-body">
               <?=Highcharts::widget([
                    'options' => [
                        'credits' => false, 
                        'title' => [
                            'text' => 'Jabatan Guru'
                        ], 
                        'exporting' => [
                            'enabled' => true
                        ], 
                        'plotOptions' => [
                            'pie' => [
                                'cursor' => 'pointer', 
                            ], 
                        ], 
                        'series' => [
                            [
                                'type' => 'pie', 
                                'name' => 'Jabatan', 
                                'data' => MpTeacherPosition::getGrafikList(), 
                            ], 
                        ], 
                    ], 
                ]) ?>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="box-header with-border">
               <!-- <h3 class="box-title">Guru Berdasarkan Status</h3> -->
            </div>
            <div class="box-body">
               <?=Highcharts::widget([
                    'options' => [
                        'credits' => false, 
                        'title' => [
                            'text' => 'Status Guru'
                        ], 
                        'exporting' => [
                            'enabled' => true
                        ], 
                        'plotOptions' => [
                            'pie' => [
                                'cursor' => 'pointer', 
                            ], 
                        ], 
                        'series' => [
                            [
                                'type' => 'pie', 
                                'name' => 'Status', 
                                'data' => MpTeacherStatus::getGrafikList(), 
                            ], 
                        ], 
                    ], 
                ]) ?>
            </div>
         </div>
      </div>
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title">Data Jabatan</h3>
         </div>
         <div class="box-body">
            <table class="table table-bordered table-hover">
               <thead class="bg-blue">
                  <tr>
                     <th style="text-align: center; color: black; width: 50px;">No</th>
                     <th style="text-align: center; color: black;">Jabatan</th>
                  </tr>
               </thead>
               <?php

                  $position = MpTeacherPosition::find()->all();
                  
                  foreach ($position as $pos)
                  {
                      echo '<tr><th colspan="3" class="info">Jabatan ' . $pos->name . "</th></tr>";
                  
                      $i = 1;
                  
                      foreach (MpTeacher::findAllPosition() as $teacher)
                      {
                  
                          if ($pos->id === $teacher->id_teacher_position)
                          {
                            echo '<tr><td style="text-align: center;">' . $i++ . '</td><td>' . $teacher->name . '</td></tr>';
                          }
                      }
                  }

                ?>
            </table>
         </div>
      </div>
   </div>
   <!-- /.card-body -->
   <div class="card-footer">
      <div class="text-center"><i><?=Html::encode($this->title) ?></i></div>
   </div>
   <!-- /.card-footer-->
</div>
<!-- /.card -->