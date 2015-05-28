<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\Record;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class FeedController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
            'access' => [
                'class'=>\yii\filters\AccessControl::className(),
                'only'=>['index',],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex($post_id = null)
    {
        $postList = [];
        $existID = false;
        $post_name = null;
        foreach (Post::find()->all() as $post) {
            $postList[] = [
                'id' => $post->id,
                'name' => $post->name,
                ];
            if ($post->id == $post_id) {
                $existID = true;
                $post_name = $post->name;
            }
        }
        if (!$existID) {
            $post_id = $postList[0]['id'];
            $post_name = $postList[0]['name'];
        }

        $query = Record::find()->where(['post_id'=>$post_id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount'=>$countQuery->count()]);
        $pages->pageSize = 1;
        $models = $query->offset($pages->offset)
            ->one();

        Yii::info('[Feed][Index] User:'.Yii::$app->user->id.' post:'.$post_id.' page:'.$pages->offset, 'biser\feed');
        return $this->render('index', [
            'model' => $models,
            'postList' => $postList,
            'pages' => $pages,
            'postTitle' => $post_name,
        ]);
    }
}
