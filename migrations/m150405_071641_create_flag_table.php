<?php

use yii\db\Schema;
use yii\db\Migration;

class m150405_071641_create_flag_table extends Migration
{
    public function up()
    {
        $this->createTable('flags', [
            'id'=>'pk',
            'name'=>'string UNIQUE',
            ], 'CHARSET=utf8');

    }

    public function down()
    {
        $this->dropTable('flags');
        return true;
    }
}
