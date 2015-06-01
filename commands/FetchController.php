<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Post;
use app\models\RssParser;
use app\models\Record;

/**
 * This command fetch the target url from db and record all new feeds into db.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Octoxie
 */
class FetchController extends Controller
{
    /**
     * Run it without parameters. All setting read from db.
     */
    public function actionIndex()
    {
        echo "Begin to sync.\n";
        foreach ($this->readAllPostFromDB() as $post){ 
            echo "Get :".$post->name."\n";
            $this->fetchURL($post->url, $post->id);
        }
    }

    private function fetchURL($url, $post_id)
    {
        $rssParser = new RssParser();
        $rssParser->load($url);
        foreach ($rssParser->getItems(false) as $record) {
            $postRecord = new Record;
            $postRecord->content = $record['description'];
            $postRecord->title = $record['title'];
            $postRecord->post_id = $post_id;
            $postRecord->save();
        }
    }

    private function readAllPostFromDB()
    {
        return Post::find()->where(['type'=>0])->all();
    }
}
