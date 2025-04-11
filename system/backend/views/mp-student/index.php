<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use backend\models\MpYear;
use backend\models\MpLevel;
use backend\models\MpSchool;


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

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Siswa';
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
            <div class="mp-student-index">
                <p>
                    <?= Html::a('Tambah Siswa', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                
                <div class="table-responsive table-nowrap">

                    <?php

                    $gridColumns = [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' => 'text-align:center']
                            ],
                                'nis',
                                'nis_old',
                                [
                                    'format' => 'raw',
                                    'headerOptions' => ['style' => 'text-align:center'],
                                    'contentOptions' => ['style' =>'text-align:center;'],
                                    'attribute' => 'status',
                                    'filter' => ['REGISTER' => 'REGISTER', 'STUDENT' => 'STUDENT'],
                                    'value' => function ($data) {
                                        return ['REGISTER' => 'REGISTER', 'STUDENT' => 'STUDENT'][$data['status']];
                                    },
                                ],
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
                                'full_name',
                                'nick_name',
                                [
                                    'attribute' => 'gender',
                                    'filter' => ['M' => 'LAKI-LAKI', 'F' => 'PEREMPUAN'],
                                    'value' => function($data) {

                                        return ['M' => 'LAKI-LAKI', 'F' => 'PEREMPUAN'][$data['gender']];
                                    }
                                ],
                                'pob',
                                'dob',
                                [
                                    'attribute' => 'nation',
                                    'filter' => ['WNI' => 'WNI', 'WNA' => 'WNA'],
                                ],
                                [
                                    'attribute' => 'religion',
                                    'filter' => [ 'Islam' => 'Islam', 'Kristen' => 'Kristen', 'Hindu' => 'Hindu', 'Budha' => 'Budha', 'Konghucu' => 'Konghucu', ],
                                ],
                                [
                                    'attribute' => 'orphan',
                                    'filter' => [ 'Yatim' => 'Yatim', 'Piatu' => 'Piatu', 'Yatim Piatu' => 'Yatim Piatu', ],
                                ],
                                'address',
                                [
                                    'attribute' => 'address_type',
                                    'filter' => [ 'Orang Tua' => 'Orang Tua', 'Asrama' => 'Asrama', 'Kost' => 'Kost', ],
                                ],
                                'province',
                                'city',
                                'district',
                                'sub_district',
                                'postcode',
                                'handphone',
                                'school_origin',
                                'other_information',
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
                                                ['title' => 'Delete', 'class' => '', 'data' => 
                                                ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 1],
                                            ]);
                                        }
                                    ]
                                ],
                        ];

                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns,
                        'filename' => 'student',
                        //'stream' => false,
                        //'linkPath' => false,
                        'batchSize' => 1024,
                    ]);

                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns,
                    ]); ?>

                </div>

            </div>

        </div>

    </div>

</div>
