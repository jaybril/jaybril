<?php
    namespace common\widgets;;
    use yii\helpers\Html;
    use yii\web\Cookie;
    use yii\widgets\Breadcrumbs;
    use Yii;

    class MySession{
        /*设置session*/
        public static function setSession($k,$v){
            if(isset($k)){
                Yii::$app->session->set($k,$v);
            }
        }
        /*取得cookie*/
        public static function getSession($k){
            if($k) {
               return Yii::$app->session->get($k);
            }
            return false;
        }
        /*保存报名数据*/
        public static function setEnrollData($list){
            foreach($list as $k=>$v){
                if(isset( $k)){
                 MySession::setSession($k,$v);
                }
            }
        }

    }