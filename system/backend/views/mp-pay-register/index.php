<?php

use backend\models\MpLevel;
use backend\models\MpPay;
use backend\models\MpYear;
use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$select_pay = ArrayHelper::map(MpPay::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_user = ArrayHelper::map(User::find()->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_year = ArrayHelper::map(MpYear::find()->orderBy(['id' => SORT_DESC])->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['nama'];
}
);

$select_level = ArrayHelper::map(MpLevel::find()->asArray()->all(),'kelas', function($model, $defaultValue) {
    return $model['kelas_c'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpPayRegisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembayaran Uang Registrasi';
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
            <div class="mp-pay-register-index">

                <p>
                    <?= Html::a('Tambah Uang Regitrasi', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_tahun',
                            'filter' => $select_year,
                            'value' => function ($data) {
                                $tahun = MpYear::findOne(['id' => $data['id_tahun']]);
                                return $tahun['nama'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_jenjang',
                            'filter' => $select_level,
                            'value' => function ($data) {
                                $level = MpLevel::findOne(['kelas' => $data['id_jenjang']]);
                                return $level['type'] . ' - ' . $level['kelas_c'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_pay',
                            'filter' => $select_pay,
                            'value' => function ($data) {
                                $pay = MpPay::findOne(['id' => $data['id_pay']]);
                                return $pay['name'] . ' - ' . $pay['description'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_user',
                            'filter' => $select_user,
                            'value' => function ($data) {
                                $user = User::findOne(['id' => $data['id_user']]);
                                return $user['name'];
                            },
                        ],
                            'type',
                            // 'nominal',
                            [
                                'attribute' => 'Nominal',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return '<b>Rp.</b>' . number_format($model->nominal, 2);
                                },
                                'headerOptions' => ['style' => 'text-align:center;'],
                                'contentOptions' => ['style' => 'text-align:left;'],
                            ],
                            'timestamp',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Action',
                                'template' => '{view} {update} {delete}',
                                'buttons' => [
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