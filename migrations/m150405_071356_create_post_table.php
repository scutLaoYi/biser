<?php

use yii\db\Schema;
use yii\db\Migration;

class m150405_071356_create_post_table extends Migration
{
    public function up()
    {
        $this->createTable('posts', [
            'id'=>'pk',
            'name'=>'string UNIQUE',
            'type'=>'integer',
            'url'=>'string',
            'type_id'=>'integer'
            ]);

    }

    public function down()
    {
        $this->dropTable('posts');
        return true;
    }
}
