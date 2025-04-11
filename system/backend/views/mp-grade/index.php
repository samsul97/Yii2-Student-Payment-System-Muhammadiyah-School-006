<?php

use backend\models\MpLevel;
use backend\models\MpYear;
use backend\models\MpSchool;
use backend\models\MpClass;
use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$select_level = ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
    return $model['kelas_c'];
}
);

$select_school = ArrayHelper::map(MpSchool::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
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

$select_user = ArrayHelper::map(User::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpGradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kenaikan Kelas';
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
            <div class="mp-grade-index">

                <p>
                    <?= Html::a('Create Tingkatan', ['grade'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Update Tingkatan', ['input'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <div class="table-responsive table-nowrap">
                    
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'header' => 'No',
                                'class' => 'yii\grid\SerialColumn',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' => 'text-align:center']
                            ],
                            'nis',
                            // 'full_name',
                            [
                                'format' => 'raw',
                                'attribute' => 'id_year',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center'],
                                'filter' => $select_year,
                                'value' => function ($data) {
                                    $year = MpYear::findOne($data['id_year']);
                                    return $year['nama'];
                                },
                            ],
                            [
                                'format' => 'raw',
                                'attribute' => 'id_school',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center'],
                                'filter' => $select_school,
                                'value' => function ($data) {
                                    $school = MpSchool::findOne($data['id_school']);
                                    return $school['name'];
                                },
                            ],
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center'],
                                'attribute' => 'id_level',
                                'filter' => $select_level,
                                'value' => function ($data) {
                                    $level = MpLevel::findOne($data['id_level']);
                                    return $level['kelas_c'];
                                },
                            ],
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center'],
                                'attribute' => 'id_class',
                                'filter' => $select_class,
                                'value' => function ($data) {
                                    $class = MpClass::findOne($data['id_class']);
                                    return $class['name'];
                                },
                            ],
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center'],
                                'attribute' => 'status',
                                'filter' => ['LULUS' => 'LULUS', 'TIDAK LULUS' => 'TIDAK LULUS'],
                                'value' => function ($data) {
                                    return $data['status'];
                                },
                            ],
                            'date',
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_user',
                                'filter' => $select_user,
                                'value' => function ($data) {
                                    $user = User::findOne($data['id_user']);
                                    return $user['name'];
                                },
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Action',
                                'template' => '{view} {update} {delete}',
                                'buttons' => [
                                    'view' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                            ['view', 'id' => $model['id']], 
                                            ['title' => 'View', 'data' => 
                                            ['pjax' => 0]
                                        ]);
                                    },
                                    'update' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>', 
                                            ['update', 'id' => $model['id']], 
                                            ['title' => 'Update', 'data' => 
                                            ['pjax' => 0]
                                        ]);
                                    },
                                    'delete' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                                            ['delete', 'id' => $model['id']], 
                                            ['title' => 'Delete', 'class' => '', 'data' => 
                                            ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 0],
                                        ]);
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
