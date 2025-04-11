<?php

use backend\models\MpTeacherPayroll;
use backend\models\MpTeacherPosition;
use backend\models\MpTeacherStatus;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

$select_position = ArrayHelper::map(MpTeacherPosition::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_status = ArrayHelper::map(MpTeacherStatus::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_payroll = ArrayHelper::map(MpTeacherPayroll::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpTeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Guru';
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
    <div class="card-block">
        <div class="card-body">
            <div class="card-text">
                <div class="mp-teacher-index">

                    <p>
                        <?= Html::a('Tambah Guru', ['create'], ['class' => 'btn btn-success']) ?>
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

                                'nip',
                                'nip_old',
                                'name',
                                'pob',
                                'dob',
                                'doe',
                                [
                                    'attribute' => 'gender',
                                    'filter' => ['M' => 'LAKI-LAKI', 'F' => 'PEREMPUAN'],
                                    'value' => function($data) {

                                        return ['M' => 'LAKI-LAKI', 'F' => 'PEREMPUAN'][$data['gender']];
                                    }
                                ],
                                [
                                    'attribute' => 'married_status',
                                    'filter' => [ 'BELUM KAWIN' => 'BELUM KAWIN', 'KAWIN' => 'KAWIN', 'JANDA' => 'JANDA', 'DUDA' => 'DUDA', ],
                                    'value' => function($data) {

                                        return [ 'BELUM KAWIN' => 'BELUM KAWIN', 'KAWIN' => 'KAWIN', 'JANDA' => 'JANDA', 'DUDA' => 'DUDA', ][$data['married_status']];
                                    }
                                ],
                                'education',
                                'address',
                                'national',
                                'province',
                                'city',
                                'district',
                                'sub_district',
                                'postcode',
                                'handphone',
                                'email:email',
                                [
                                    'format' => 'raw',
                                    'headerOptions' => ['style' => 'text-align:center'],
                                    'contentOptions' => ['style' =>'text-align:center;'],
                                    'attribute' => 'id_teacher_position',
                                    'filter' => $select_position,
                                    'value' => function ($data) {
                                        $position = \yii\helpers\ArrayHelper::map(MpTeacherPosition::find()->asArray()->all(),
                                            function($model, $defaultValue) 
                                            {
                                                return ($model['id']);
                                            },
                                            'name'
                                        );
                                        if (array_key_exists($data['id_teacher_position'], $position))
                                        {
                                            return $position[$data['id_teacher_position']];
                                        }
                                    },
                                ],
                                [
                                    'format' => 'raw',
                                    'headerOptions' => ['style' => 'text-align:center'],
                                    'contentOptions' => ['style' =>'text-align:center;'],
                                    'attribute' => 'id_teacher_payroll',
                                    'filter' => $select_payroll,
                                    'value' => function ($data) {
                                        $payroll = \yii\helpers\ArrayHelper::map(MpTeacherPayroll::find()->asArray()->all(),
                                            function($model, $defaultValue) 
                                            {
                                                return ($model['id']);
                                            },
                                            'name'
                                        );
                                        if (array_key_exists($data['id_teacher_payroll'], $payroll))
                                        {
                                            return $payroll[$data['id_teacher_payroll']];
                                        }
                                    },
                                ],
                                [
                                    'format' => 'raw',
                                    'headerOptions' => ['style' => 'text-align:center'],
                                    'contentOptions' => ['style' =>'text-align:center;'],
                                    'attribute' => 'id_teacher_status',
                                    'filter' => $select_status,
                                    'value' => function ($data) {
                                        $status = \yii\helpers\ArrayHelper::map(MpTeacherStatus::find()->asArray()->all(),
                                            function($model, $defaultValue) 
                                            {
                                                return ($model['id']);
                                            },
                                            'name'
                                        );
                                        if (array_key_exists($data['id_teacher_status'], $status))
                                        {
                                            return $status[$data['id_teacher_status']];
                                        }
                                    },
                                ],
                                // 'id_teacher_position',
                                // 'id_teacher_payroll',
                                // 'id_teacher_status',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Action',
                                    'template' => '{view} {update} {delete}',
                                    'buttons' => [
                                        'view' => function($url, $model) {
                                            return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                                ['view', 'id' => $model['nip']], 
                                                ['title' => 'View', 'data' => 
                                                ['pjax' => 1]
                                            ]);
                                        },
                                        'update' => function($url, $model) {
                                            return Html::a('<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>', 
                                                ['update', 'id' => $model['nip']], 
                                                ['title' => 'Update', 'data' => 
                                                ['pjax' => 1]
                                            ]);
                                        },
                                        'delete' => function($url, $model) {
                                            return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                                                ['delete', 'id' => $model['nip']], 
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
                                'filename' => 'teacher',
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

</div>
