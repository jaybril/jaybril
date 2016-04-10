<?php
    namespace common\widgets;;
    use yii\helpers\Html;
    use yii\widgets\Breadcrumbs;
    use Yii;

    class MyCache{
        private static $_instance;
        private function __construct(){
            return Yii::$app->cache;
        }
        private function __clone(){
        }
        public static function getInstance()
        {
            if(! (self::$_instance instanceof self) )
            {
                self::$_instance = new self();
            }
            return self::$_instance;

        }
        /*设置cache*/
        public static function setCache($k,$v,$time=''){
            $value=Yii::$app->cache->get($k);
            if($value===false)
            {
                if($time){
                    return  Yii::$app->cache->add($k,$v,$time);
                }
                else{
                    return  Yii::$app->cache->add($k,$v);
                }

            }
            if($time){
                return  Yii::$app->cache->set($k,$v,$time);
            }
            else{
                return  Yii::$app->cache->set($k,$v);
            }
            return false;
        }
        /*取得cache*/
        public static function getCache($k){
            if($k) {
                return Yii::$app->cache->get($k);
            }
            return false;
        }
        /*设置用户登录状态*/
        public static function setUserLoginCache($userId,$token,$userType){
            if(!($userId && $token)){
                return false;
            }
            $su=MyCache::setCache(Variable::$cache_userId,$userId) && MyCache::setCache(Variable::$cache_userToken,$token) && MyCache::setCache(Variable::$cache_userType,$userType);
            return $su;
        }
        /*获得用户登录状态*/
        public static function getUserLoginStatus(){
            $type=MyCache::getCache(Variable::$cache_userType);
            $token=MyCache::getCache(Variable::$cache_userToken);
//            if($type!=$userType){
//                return false;
//            }
            if(!isset($token) || empty($token)){
                return false;
            }
            return true;
        }
        /*清除所有cache*/
        public static function clearAllCache(){
            Yii::$app->cache->flush();
        }
    }