<?php
/* @var $this yii\web\View */
$this->title = 'Welcome To Biser';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">欢迎来到Biser数据聚合服务</p>
    </div>

    <div class="body-content">

        <div class="row">
<?php foreach($summary as $s) {?>
            <div class="col-lg-4">
            <h2><?php echo $s['title'];?></h2>

            <p><?php echo $s['post_name']; ?></p>

            <p><a class="btn btn-default" href="/feed/index?post_id=<?php echo $s['post_id']; ?>">Read more</a></p>
            </div>
<?php } ?>
        </div>

    </div>
</div>
