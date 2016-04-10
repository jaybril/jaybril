<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/13
 * Time: 10:35
 */
    namespace frontend\models;
    use yii\base\Model;
    use yii\captcha\Captcha;


    class LoginForm extends Model
    {
        public $name;
        public $password;
        public $verifyCode;
        public $error;

    }