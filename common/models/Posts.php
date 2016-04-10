<?php
/**
 * Created by $顾家进.
 * User: jaybril
 * Date: 2016/4/8 0008
 * Time: 下午 8:35
 * Info:
 */
namespace common\models;
use yii\db\ActiveRecord;
class Posts extends ActiveRecord{
    public static function getArticleList(){
        $model=Posts::find()->all();
        if($model){
            return $model;
        }
        return false;
    }
}