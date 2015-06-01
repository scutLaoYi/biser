<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $url
 * @property integer $type_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'type_id'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'url' => 'Url',
            'type_id' => 'Type ID',
        ];
    }

    public static function getSummaryPost()
    {
        $summarySize = 3;
        $postARs = Post::findBySql("select id, name from posts limit $summarySize")->asarray()->all();
        return $postARs;
    }
}
