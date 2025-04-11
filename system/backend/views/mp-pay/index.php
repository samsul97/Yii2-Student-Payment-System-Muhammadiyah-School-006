<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\MpPayType;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpPaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipe Pembayaran';
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
            <div class="mp-pay-index">

                <p>
                    <?= Html::a('Tambah Tipe Pembayaran', ['create'], ['class' => 'btn btn-success']) ?>
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
                            'name',
                            'description',
                            [
                                'attribute' => 'type',
                                'filter' => ['CASH' => 'CASH', 'CREDIT' => 'CREDIT'],
                            ],
                            [
                                'attribute' => 'type_pay',
                                'filter' =>  ArrayHelper::map(MpPayType::find()->asArray()->all(),'id', 'name'),
                                'value' => function ($data) {
                                    $mp_pay = MpPayType::findOne($data['type_pay']);
                                    return $mp_pay['name'];
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

