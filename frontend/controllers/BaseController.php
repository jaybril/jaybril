<?php
/**
 * 项目的基础控制器
 * User: gujiajin
 * Date: 2015/12/28
 * Time: 9:25
 */
    namespace frontend\controllers;
    use common\models\Region;
    use common\widgets\InterfaceApi;
    use common\widgets\MyCache;
    use common\widgets\MyCookie;
    use common\widgets\Tool;
    use common\widgets\Variable;
    use Yii;
    use yii\web\Controller;

    class BaseController extends Controller{
        public function beforeAction($action){
            $this->setSuperId();
            return parent::beforeAction($action);
        }
        /*获取并保存推广id*/
        public function setSuperId(){
            $r=trim(Yii::$app->request->get('r'));
            if(empty($r)) {
                $r = trim(Yii::$app->request->post('r'));
            }
            $superR=MyCookie::getCookie(Variable::$cookie_super_r);
            if($r && empty($superR)){
                MyCookie::setCookie(Variable::$cookie_super_r,$r);
            }
        }
        /*获取用户信息*/
        public function getUserInfo(){
            $model=false;
            $json=InterfaceApi::getApi(InterfaceApi::$getUserInfo);
            if($json && $json->success && $json->res){
                $model=$json->res;;
            }
            return $model;
        }

        /*文件上传*/
        public function uploadFile($file){
            $data=[
                'file'=>$file
            ];
            $json=InterfaceApi::getApi(InterfaceApi::$upload,1,$data);
            return $json;
        }
        /*获取本地图片curl对象*/
        public function getImageObject($imgUrl){
            $object='';
            if(!empty($imgUrl)){
                if(!strstr($imgUrl,'http')){
                    $imgUrl=substr($imgUrl,1);
                    $imgUrl=''.realpath($imgUrl);
                    if (function_exists('curl_file_create')) {
                        $object= curl_file_create($imgUrl, 'image/jpeg', '1.jpg');
                    }
                }
            }
            return $object;
        }
        /*获取省市区列表*/
        public function actionGetrangelist(){
            $type=intval(Yii::$app->request->post('type'));
            $id=trim(Yii::$app->request->post('id'));
            switch($type){
                case 0:
                   echo json_encode(Region::getProvinceList());
                    break;
                case 1:
                    echo json_encode ( Region::getCityList($id));
                    break;
                case 2:
                    echo json_encode( Region::getAreaList($id));
                    break;
            }
        }
        /*获取省份列表*/
        public function getProvinceList(){
            $list=[];
            $json=InterfaceApi::getApi(InterfaceApi::$getProvinceList,1,[]);
            if($json && $json->success){
                $list=$json->res;
            }
            return $list;
        }
        /*获取城市列表*/
        public function getCityListByProvinceId($province_id){
            $list=[];
            $json=InterfaceApi::getApi(InterfaceApi::$getCityList,1,['province_id'=>$province_id]);
            if($json && $json->success){
                $list=$json->res;
            }
            return $list;
        }
        /*获取区列表*/
        public function getAreaListByCityId($city_id){
            $list=[];
            $json=InterfaceApi::getApi(InterfaceApi::$getAreaList,1,['city_id'=>$city_id]);
            if($json && $json->success){
                $list=$json->res;
            }
            return $list;
        }
    }