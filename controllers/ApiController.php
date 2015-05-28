<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Post;
use app\models\Record;
use app\models\UserAR;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionLogin()
    {
        $post = Yii::$app->request->post();
        $paraKeys = array('username', 'password');
        if (!$this->parametersCheck($paraKeys, $post)){
            $this->response(False, "parameter error", 0);
            return;
        } 

        $token = User::apiValidate($post['username'], $post['password']);
        if ($token) {
            Yii::info("[API][Login][Success] User:".$post['username'], 'biser\api');
            $this->response(True, "login success", array('token'=>$token));
        } else {
            $this->response(False, "password error", 0);
        }
    }

    public function actionPosts()
    {
        $post = Yii::$app->request->post();
        $paraKeys = array("username", "token");
        if (!$this->parametersCheck($paraKeys, $post)) {
            $this->response(False, "parameter error", 0);
            return;
        }

        if (User::apiTokenValidate($post['username'], $post['token'])) {
            $postList = [];
            foreach (Post::find()->all() as $post) {
                $postList[] = [
                    'id' => $post->id,
                    'name' => $post->name,
                ];
            }
            Yii::info("[API][Get Post][Success] User:".$post['username'], 'biser\api');
            $this->response(True, "get post list ok", $postList);
        } else {
            $this->response(False, "token error", 0);
        }
    }

    public function actionFeeds()
    {
        $post = Yii::$app->request->post();
        $paraKeys = array("username", "token", "post_id", "page");
        if (!$this->parametersCheck($paraKeys, $post)) {
            $this->response(False, "parameter error", 0);
            return;
        }

        if (User::apiTokenValidate($post['username'], $post['token'])) {
            $feedList = Record::fetchWithPage($post['post_id'], $post['page']);
            Yii::info("[API][Get Feed][Success] User:".$post['username'], 'biser\api');
            $this->response(True, "get feed list ok", $feedList);
        } else {
            $this->response(False, "token error", 0);
        }

    }

    private function parametersCheck($keys, $post_data) 
    {
        foreach ($keys as $k) {
            if (!array_key_exists($k, $post_data)) {
                Yii::warning("[API][Parameter][Error]".json_encode($post_data), 'biser\api');
                return false;
            }
        }
        return true;
    }

    private function response($status, $message, $data)
    {
        if (!$status) {
            Yii::warning("[API][Request Failed]".$message, 'biser\api');
        }

        $response = array();
        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function actionTest($para)
    {
        echo md5($para);
    }
}
