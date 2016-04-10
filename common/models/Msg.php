<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/24
 * Time: 11:49
 */
    namespace common\models;
use yii\base\Model;

class Msg extends Model{
    public  $status=0;//0-失败  1-成功
    public  $message;//
    public  $backUrl='/';//
    public  $title='叮叮功课';
    public  $buttonLabel='返回主页';

    private static $_instance; /*保存类实例的静态成员变量*/
    //private标记的构造方法
     function __construct(){
//         return self::$_instance;
     }
    //创建__clone方法防止对象被复制克隆
    public function __clone(){
        trigger_error('Clone is not allow!',E_USER_ERROR);
    }

    //单例方法,用于访问实例的公共的静态方法
    public static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function setMsgInfo($status='',$message='',$backUrl='',$title='',$buttonLabel=''){
        $this->status=$status;
        $this->message=$message;
        $this->backUrl=$backUrl;
        $this->title=$title;
        $this->buttonLabel=$buttonLabel;
        return self::$_instance;
    }
    public function getTitle(){
        return $this->title;
    }
}