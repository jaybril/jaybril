<?php
/**
 * 全局工具函数
 * User: 顾家进
 * Date: 2015/11/11
 * Time: 10:39
 */
    namespace common\widgets;;
    use yii\helpers\Html;
    use yii\log\Logger;
    use yii\widgets\Breadcrumbs;
    use common\widgets\pageUrl;
    use common\widgets\Variable;
    use common\widgets\MyCache;
    use Yii;

class Tool{
    /*获得当前IP
     *
     */
    public static function getIp()
    {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
        {
            $onlineip = getenv('HTTP_CLIENT_IP');
        }elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
        {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        }elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
        {
            $onlineip = getenv('REMOTE_ADDR');
        }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
        {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }
    /*
     *输出编码后的字符串
     * @pram $string  需要输出的字符串
     * @pram $default 当该$string为空时 输出的默认的字符串
     */
    public static function echoEncodeString($string,$default=''){
        if($string!='0') {
            $string = $string ? $string : $default;
        }
        return Html::encode($string);
    }
    /*
     *星号替换函数
     * @pram $str 需要替换的字符串
     * @pram $start 字符串的何处开始替换
     * 　if(正数) => 在第 start 个偏移量开始替换
     *   if(负数) => 在从字符串结尾的第 start 个偏移量开始替换
     *   if(0) => 在字符串中的第一个字符处开始替换
     * @pram length 规定要替换多少个字符。
     *  if(正数) =>被替换的字符串长度，从左往右
　　 *  if(负数) => 被替换的字符串长度，从右往左
　　 *  if(0) => 如果start为正数，从start开始向左到最后
     */
    public static function replaceStringWithStar($str, $start, $length = 0,$type='*'){
        $i = 0;
        $star = '';
        //在第 start 个偏移量开始替换
        if($start >= 0) {
            if($length > 0) {
                $str_len = strlen($str);//获取字符串的长度
                $count = $length;
                if($start >= $str_len) {//当开始的下标大于字符串长度的时候，就不做替换了
                    $count = 0;
                }
            }elseif($length < 0){
                $str_len = strlen($str);//获取字符串的长度
                $count = abs($length);//返回长度的绝对值
                if($start >= $str_len) {//当开始的下标大于字符串长度的时候，由于是反向的，就从最后那个字符的下标开始
                    $start = $str_len - 1;
                }
                $offset = $start - $count + 1;//起点下标减去数量，计算偏移量
                $count = $offset >= 0 ? abs($length) : ($start + 1);//偏移量大于等于0说明没有超过最左边，小于0了说明超过了最左边，就用起点到最左边的长度
                $start = $offset >= 0 ? $offset : 0;//从最左边或左边的某个位置开始
            }else {
                $str_len = strlen($str);
                $count = $str_len - $start;//计算要替换的数量
            }
        }else {
            if($length > 0) {
                $offset = abs($start);
                $count = $offset >= $length ? $length : $offset;//大于等于长度的时候 没有超出最右边
            }elseif($length < 0){
                $str_len = strlen($str);
                $end = $str_len + $start;//计算偏移的结尾值
                $offset = abs($start + $length) - 1;//计算偏移量，由于都是负数就加起来
                $start = $str_len - $offset;//计算起点值
                $start = $start >= 0 ? $start : 0;
                $count = $end - $start + 1;
            }else {
                $str_len = strlen($str);
                $count = $str_len + $start + 1;//计算需要偏移的长度
                $start = 0;
            }
        }
        while ($i < $count) {
            $star .= $type;
            $i++;
        }

        if(preg_match("/[\x7f-\xff]/", $str)){
            if(Tool::checkStrIsUTF8($str)){
                return substr_replace($str,$type,$start*3, $count*3);
            }
            else{
                return substr_replace($str,$type,$start*2, $count*2);
            }
        }else{
            return substr_replace($str,$type,$start, $count);
        }
        return str_replace($str, $star, $type, $count);
    }
    /*
     *检查字符串是否为UTF-8
     * @pram $str  需要检查的字符串
     * @return true =>是utf-8字符串
     * @return false=>不是
     *
     */
    public static function checkStrIsUTF8($str){
        if(preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$str) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$str) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$str) == true) {
            return true;
        }else {
            return false;
        }
    }
    /*
     *设置面包屑
     */
    public static function setBreadcrumbs($arr){
        $linksArr=[];
        foreach($arr as $k=>$v){
            $url=null;
            if(isset($v[1])){
                $url=$v[1];
            }
            $template=null;
            if(isset($v[2])){
                $template=$v[2];
            }
            $class="<li>{link}</li>";
            if(isset($v[3])){
                $class=$v[3];
            }
            array_push($linksArr,[
                'label'=>$v[0] ? $v[0]:'',
                'url'=>$url,
                'template'=>$template,
                'options'=>['class'=>$class]
            ]);
        }
        return  Breadcrumbs::widget([
            'homeLink'=>['label' => '主 页','url' => Yii::$app->homeUrl],
            'links' => $linksArr
        ]);
    }
    /*
     * curlRequest
     * 服务器通过get请求获得内容
     * @param string $url       请求的url,如果是get方式 则是拼接后的url
     * @param string $post       不填则为get请求
     * @param string $postData   post请求是数据
     * @return $res           请求返回的内容
     */
    public static  function curlRequest($url,$post=false,$postData=[]){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果成功只将结果返回，不自动输出任何内容
        curl_setopt($ch, CURLOPT_TIMEOUT, 500);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if($post){
//            curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
            curl_setopt($ch, CURLOPT_POST, 1); // post过去
            curl_setopt($ch,CURLOPT_POSTFIELDS,$postData);//数据
        }
        $token=MyCookie::getCookie(Variable::$cookie_userToken);
        $cookie='';
//        print_r(Yii::$app->request->cookies);
        if($token) {
            $cookie = 'token='.$token;
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($ch, CURLOPT_HEADER, $cookie);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        Yii::getLogger()->log('api请求：'.$url,Logger::LEVEL_TRACE , 'Interface');
        $res=curl_exec($ch);
        return $res;
    }
    /*
     *二维数组去掉重复值  并保留键值
     * @param string $array2D       二位数组
     * @return $temp  --去重后的数组
     */
    public static  function array_unique_fb($array2D)
    {
        if(!is_array($array2D)){
            return false;
        }
        foreach ($array2D as $v)
        {
            $v = join(",",$v);  //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
            $temp[] = $v;
        }

        $temp = array_unique($temp);    //去掉重复的字符串,也就是重复的一维数组
        foreach ($temp as $k => $v)
        {
            $temp[$k] = explode(",",$v);   //再将拆开的数组重新组装
        }
        return $temp;
    }
    /*
     * 登录跳转不同的角色中心
     *@return url  返回跳转到不同角色的用中心URL
     */
    public static function getSkipToUserCenterUrl(){
        $url=pageUrl::$homeUrl;
        $token=MyCookie::getCookie(Variable::$cookie_userToken);
        $type=MyCookie::getCookie(Variable::$cookie_userType);

        if(empty($token)){
            $url= pageUrl::$homeUrl;
        }
        if(is_numeric($type) && $type<4){
            $url=Variable::$userTypeUrlList[$type];
        }

        return $url;
    }
    /*
     *数组对象转数组
     *
     */
    public static function  objectToArray($array) {
        if(is_object($array)) {
            $array = (array)$array;
        } if(is_array($array)) {
            foreach($array as $key=>$value) {
                $array[$key] = Tool::objectToArray($value);
            }
        }
        return $array;
    }
}

