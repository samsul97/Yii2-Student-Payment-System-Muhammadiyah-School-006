<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MpTeacher */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Data Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
            <div class="mp-teacher-view">
                <p>
                    <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Update', ['update', 'id' => $model->nip], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->nip], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'format' => 'raw',
                            'attribute' => 'image',
                            'value' => function ($data) {

                                $image = $data['image'] && is_file(Yii::getAlias('@webroot') . $data['image']) ? $data['image'] : '../images/no_photo.jpg';
                                return Html::img(Url::base().$image, ['height' => '200']);
                            },
                        ],
                        'nip',
                        'nip_old',
                        'name',
                        'pob',
                        'dob',
                        'doe',
                        'gender',
                        'married_status',
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
                        'id_teacher_position',
                        'id_teacher_payroll',
                        'id_teacher_status',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>