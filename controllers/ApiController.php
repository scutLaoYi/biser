<?php

namespace app\controllers;

use Yii;
use app\models\User;
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

        $response = array();
        $token = User::apiValidate($post['username'], $post['password']);
        if ($token) {
            $this->response(True, "login success", array('token'=>$token));
        } else {
            $this->response(False, "password error", 0);
        }
    }

    public function actionGetPosts()
    {
        $post = Yii::$app->request->post();
        $paraKeys = array("username", "token");
        if (!$this->parametersCheck($paraKeys, $post)) {
            response(False, "parameter error", 0);
        }

        $response = array();
        if (User::apiTokenValidate($username, $token)) {
        } else {
        }
    }

    private function parametersCheck($keys, $post_data) 
    {
        foreach ($keys as $k) {
            if (!array_key_exists($k, $post_data)) {
                return false;
            }
        }
        return true;
    }

    private function response($status, $message, $data)
    {
        $response = array();
        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $data;
        echo json_encode($response);
    }
}
