<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserAR */

$this->title = 'Create User Ar';
$this->params['breadcrumbs'][] = ['label' => 'User Ars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-ar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
