<?php

use yii\db\Schema;
use yii\db\Migration;

class m150405_070312_create_user_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id'=>'pk',
            'username'=>'string UNIQUE',
            'password'=>'string',
            'email'=>'string'
            ], 'CHARSET=utf8');

    }

    public function down()
    {
        $this->dropTable('users');
        return true;
    }
}
