<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $postTitle;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feed-index">

    <h1><?= Html::encode($this->title.':'.$model->title) ?></h1>

    <p>
        <?= Html::a('Add Feed', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
        echo $model->content;
        echo LinkPager::widget([
            'pagination'=>$pages,
        ]);
?>

</div>
