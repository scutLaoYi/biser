<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserAR */

$this->title = 'Update User Ar: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Ars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-ar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
