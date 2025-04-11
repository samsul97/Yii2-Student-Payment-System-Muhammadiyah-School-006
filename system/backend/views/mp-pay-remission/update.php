<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MpPayRemission */

$this->title = 'Update Mp Pay Remission: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mp Pay Remissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mp-pay-remission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
