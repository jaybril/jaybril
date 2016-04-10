<?php
namespace frontend\controllers;
use common\models\Posts;
use common\models\User;
use common\models\UserForm;
use common\widgets\InterfaceApi;
use common\widgets\JsonParser;
use common\widgets\MyCache;
use common\widgets\MyCookie;
use common\widgets\MySession;
use common\widgets\Tool;
use frontend\models\LoginForm;
use Yii;
use common\widgets\pageUrl;
use common\widgets\Variable;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    public $layout='template';
    /*首页*/
    public function actionIndex(){
//        var_dump(Posts::getArticleList());
        return $this->render(pageUrl::$home);
    }

     public function actionRead(){
         return $this->render(pageUrl::$site_read);
     }
    public function actionError(){
        return $this->render(pageUrl::$error_url);
    }
}
