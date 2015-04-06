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


    <div class="col-md-2" >
        <h1><?= Html::encode('订阅列表') ?><h1>
<?php
foreach ($postList as $post) {
    echo Html::a($post['name'], ['index?post_id='.$post['id']]);
    echo '<br>';
}
?>
    </div>
    <div class="col-md-10" >
    <h1><?= Html::encode($model->title) ?></h1>
<?php
        echo $model->content;
        echo LinkPager::widget([
            'pagination'=>$pages,
        ]);
?>
    </div>

</div>
