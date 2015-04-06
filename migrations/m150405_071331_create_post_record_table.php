<?php

use yii\db\Schema;
use yii\db\Migration;

class m150405_071331_create_post_record_table extends Migration
{
    public function up()
    {
        $this->createTable('records', [
            'id'=>'pk',
            'title'=>'string UNIQUE',
            'content'=>'text',
            'post_id'=>'integer'
            ],  'CHARSET=utf8');

    }

    public function down()
    {
        $this->dropTable('records');
        return true;
    }
}
