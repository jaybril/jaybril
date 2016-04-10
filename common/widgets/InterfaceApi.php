<?php
    namespace common\widgets;
    class InterfaceApi {
        /*服务器地址*/
        public static $base='http://192.168.2.6:8080/api/';

        /*URL请求函数*/
        public static function getApi($ref,$post='',$data=''){
            if(!strstr($ref,'dingdinggongke.com')){
                $ref=  InterfaceApi::$base.$ref;
            }
            $json=Tool::curlRequest($ref,$post,$data);
            $res=json_decode($json,false);
            $isOk=false;
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    $isOk=true;
                    break;
                case JSON_ERROR_DEPTH:
                    echo ' - Maximum stack depth exceeded';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    echo ' - Underflow or the modes mismatch';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    echo ' - Unexpected control character found';
                    break;
                case JSON_ERROR_SYNTAX:
                    echo ' - Syntax error, malformed JSON';
                    break;
                case JSON_ERROR_UTF8:
                    echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                    break;
                default:
                    echo ' - Unknown error';
                    break;
            }
            if($isOk){
                return $res;
            }
            return false;
        }
    }