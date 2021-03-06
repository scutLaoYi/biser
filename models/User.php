<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $authKey;
    public $accessToken;

    private static function buildUser($userAR)
    {
        $user = new User();
        $user->username = $userAR->username;
        $user->password = $userAR->password;
        $user->id = $userAR->id;
        $user->email = $userAR->email;
        return $user;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $userAR = UserAR::findOne($id);
        if($userAR) {
            return self::buildUser($userAR);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $userAR = UserAR::find()->where(['username'=>$username])->one();
        if ($userAR) {
            return self::buildUser($userAR);
        }
        return null;
    }

    private static function generateToken($user) {
        return md5($user->username.$user->password.'api_secret_salt');
    }

    public static function apiValidate($name, $password) {
        $user = User::findByUsername($name);
        if ($user) {
            if ($user->validatePassword($password)) {
                return User::generateToken($user);
            }
        }
        return null;
    }

    public static function apiTokenValidate($username, $token) {
        $user = User::findByUsername($username);
        if ($user) {
            $realToken = User::generateToken($user);
            if ($realToken === $token) {
                return true;
            }
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    private function hashPassword($username, $password) {
        return md5($username.$password);
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $this->hashPassword($this->username, $password);
    }

    /**
     * Personal hack
     */
    public function isAdmin()
    {
        return $this->username === 'admin';
    }

}
