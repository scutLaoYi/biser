<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "records".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $post_id
 */
class Record extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'records';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['post_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'post_id' => 'Post ID',
        ];
    }

    public static function fetchWithPage($post_id, $page) 
    {
        $query = Record::find()->where(['post_id'=>$post_id]);
        $models = $query->offset($page)->one();
        return $models->attributes;

    }
    
}
