<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/2 0002
 * Time: 下午 3:07
 *
 */
namespace common\models;
use yii\base\Object;
use common\widgets\Variable;
use Yii;

class BaseForm extends Object{
    public $error;
    public $scene;
    public $required=true;
    /*规则*/
    public  function  rules(){
        return [
//        'coll'=>[required,'error_text',''],
            ];
    }
    /*场景*/
    public  function  scenes(){

    }
    /*校验*/
    public function validate(){
        if(!$this->scene){
            return false;
        }
        $scenes=$this->scenes();
        $rules=$this->rules();
        $list=$scenes[$this->scene];
        $reflector = new \ReflectionClass($this);
        $isOk=true;
        foreach($list as $k=>$v){
            $name=$reflector->getProperty($v)->getName();
            $r=$rules[$name];
            //如果规则为空 则不校验
            if(empty($r)){
                continue;
            }
            if($r[0]){
                if(empty($this->$name)){
                    \Yii::$app->session->setFlash(Variable::$session_error,$r[1]);
                    $isOk=false;
                    break;
                }
            }
        }
        if($isOk){
            return true;
        }
        return false;
    }
}