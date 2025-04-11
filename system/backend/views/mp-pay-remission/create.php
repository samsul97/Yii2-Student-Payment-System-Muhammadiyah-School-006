<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MpPayRemission */

$this->title = 'Create Mp Pay Remission';
$this->params['breadcrumbs'][] = ['label' => 'Mp Pay Remissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mp-pay-remission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
