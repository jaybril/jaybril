<?php
    namespace common\widgets;;
    use yii\base\Exception;
    use yii\helpers\Html;
    use yii\web\Cookie;
    use yii\widgets\Breadcrumbs;
    use Yii;

    class MyCookie{
        /*设置cookie*/
        public static function setCookie($k,$v,$time=''){
            $cookies = Yii::$app->response->cookies;

            $headers=Yii::$app->request->headers;
            $domain=explode(':',$headers['host'])[0];
            if($domain=='localhost'){
                $domain='';
            }
            if(strstr($domain,'dingdinggongke.com')){
                $domain='.dingdinggongke.com';
            }
            date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai'   亚洲/上海
            $new=new Cookie([
                'name' => $k,
                'value' => $v,
                'expire'=>time()+60*20*24*365,
                'domain'=>MyCookie::getDomain()
            ]);

            try{
                if($cookies->has($k)){
                    $cookies->remove($k);
                }
                $cookies->add($new);
            }
            catch(Exception $e){
                print_r($e->getMessage());
            }
        }
        /*取得cookie*/
        public static function getCookie($k){
            if($k) {
                $cookies = Yii::$app->request->cookies;//注意此处是request
                return $cookies->getValue($k);
            }
            return false;
        }
        /*设置用户登录状态*/
        public static function setUserLoginStatus($userId,$token,$userType){
            if(!($userId && $token)){
                return false;
            }
            MyCookie::setCookie(Variable::$cookie_userId,$userId);
            MyCookie::setCookie(Variable::$cookie_userToken,$token);
            MyCookie::setCookie(Variable::$cookie_userType,$userType);

            return true;
        }
        /*获得用户登录状态*/
        public static function getUserLoginStatus(){
            $token=MyCookie::getCookie(Variable::$cookie_userToken);
            if(!isset($token) || empty($token)){
                return false;
            }
            return true;
        }
        /*设置报名数据*/
        public static function setEnrollData($enroll,$enrolledId,$selectTimes,$description,$childId){
            MyCookie::setCookie(Variable::$cookie_enrollMsg_tag,$enroll);
            MyCookie::setCookie(Variable::$cookie_enrollMsg_enrolledId,$enrolledId);
            MyCookie::setCookie(Variable::$cookie_enrollMsg_selectTimes,$selectTimes);
            MyCookie::setCookie(Variable::$cookie_enrollMsg_description,$description);
            MyCookie::setCookie(Variable::$cookie_enrollMsg_childId,$childId );
            return true;
        }
        /*设置用户地址搜索历史*/
        public static function setSearchAddressHistory($v){
            if(empty($v)){
                return;
            }
            //地址搜索历史拼接：v+'_dd_search_'+v+'_dd_search_'+v+'_dd_search_'
            $his=MyCookie::getCookie(Variable::$cookie_enrollSearch_history);
            $spilt='_dd_search_';
            $v=$his.$spilt.$v;
            MyCookie::setCookie(Variable::$cookie_enrollSearch_history,$v);
        }
        /*获得用户地址搜索历史*/
        public static function getSearchAddressHistory(){
            $v=MyCookie::getCookie(Variable::$cookie_enrollSearch_history);
            $list=explode('_dd_search_',$v);
            $res=[];
            if(empty($list)){
                return $res;
            }
            foreach($list as $k=>$v){
                $tmp=[];
                if(!empty($v)){
                    $tmp['address']=$v;
                    $tmp['type']='';
                    $tmp['count']='';
                    if($tmp){
                        $res[]=$tmp;
                    }
                }
            }
            return $res;
        }
        /*清除cookie*/
        public static function clearCookie($k){
            if($k){
                $k=new Cookie([
                    'name' => $k,
                    'expire'=>time()+60*20*24*365,
                    'domain'=>MyCookie::getDomain()
                ]);
                $cookies=Yii::$app->response->cookies;
                Yii::$app->response->cookies->remove($k);
            }
        }
        /*清除所有cookie*/
        public static function clearAllCookie(){
//            Yii::$app->response->cookies->remove(Variable::$cookie_userId);
//            Yii::$app->response->cookies->remove(Variable::$cookie_userType);
//            Yii::$app->response->cookies->remove(Variable::$cookie_userToken);
            MyCookie::clearCookie(Variable::$cookie_userId);
            MyCookie::clearCookie(Variable::$cookie_userType);
            MyCookie::clearCookie(Variable::$cookie_userToken);
            if(MyCookie::getUserLoginStatus()){
                return false;
            }
            return true;
        }
        /*获取domain*/
        public static function getDomain(){
            $headers=Yii::$app->request->headers;
            $domain='';
            if(isset($headers['host']) && !empty($headers['host'])) {
                $domain = explode(':', $headers['host'])[0];
                if ($domain == 'localhost') {
                    $domain = '';
                }
            }
            if(strstr($domain,'dingdinggongke.com')){
                $domain='.dingdinggongke.com';
            }
            return $domain;
        }
    }