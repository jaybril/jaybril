<?php
    /* UserController：所有角色controller的父类controller
     * 功能：提供一些基础方法供子容器直接调用，减少代码重复
     * 日期：2015-12-01
     * 作者：顾家进
     */
    namespace frontend\controllers;
    use common\models\CageGroup;
    use common\models\ManufactureForm;
    use common\models\Manufacturer;
    use common\models\ManufacturerForm;
    use common\models\Region;
    use common\models\User;
    use common\models\UserForm;
    use common\widgets\MySession;
    use common\widgets\Variable;
    use Yii;
    use yii\web\Controller;
    use common\widgets\InterfaceApi;
    use common\widgets\pageUrl;
    use common\widgets\MyCookie;
    class UserController extends  BaseController{
        /*action前的行为-判断登录状态*/
        public $layout='template';
        public $user_id='';
        public function beforeAction($action){
            $this->user_id=MySession::getSession(Variable::$session_userId);
            if(!$this->user_id){
                $this->redirect(pageUrl::$login);
                return true;
            }
            return parent::beforeAction($action);
        }
        public function actionIndex(){
            $model= User::getUserInfo($this->user_id);
            return $this->render(pageUrl::$user_index,['model'=>$model]);
        }
        public function actionCompany(){
            $req=Yii::$app->request;
            $model= User::getUserInfo($this->user_id);
            if(empty($model)){
                $this->redirect(pageUrl::$login);
                return;
            }
            $form=new UserForm();
            $form->scene='company';
            if(isset($_POST['submit'])){
                $form->company_name=trim($_POST['company_name']);
                $form->company_number=trim($_POST['company_number']);
                $form->company_leader=trim($_POST['company_leader']);
                $form->id_card_no=trim($_POST['id_card_no']);
                $form->company_cage_count=trim($_POST['company_cage_count']);
                if($form->validate()) {
                    if (User::company([
                        'id'=>$model->id,
                        'company_name'=>$form->company_name,
                        'company_number'=>$form->company_number,
                        'company_leader'=>$form->company_leader,
                        'id_card_no'=>$form->id_card_no,
                        'company_cage_count'=>$form->company_cage_count
                    ])) {
                        Yii::$app->session->setFlash(Variable::$session_success, '数据更新成功');
                    }
                }
                else{
                    Yii::$app->session->setFlash(Variable::$session_error,'数据更新失败，请重试');
                }
            }
            else {
                $model = User::getUserInfo($this->user_id);
                $form->company_name = $model->company_name;
                $form->company_number = $model->company_number;
                $form->company_leader = $model->company_leader;
                $form->id_card_no = $model->id_card_no;
                $form->company_cage_count = $model->company_cage_count;
            }
            return $this->render(pageUrl::$user_company,['model'=>$form]);
        }
        public function actionArea(){
            $req=Yii::$app->request;
            $model= User::getUserInfo($this->user_id);
            if(empty($model)){
                $this->redirect(pageUrl::$login);
                return;
            }
            $form=new UserForm();
            $form->scene='area';
            if(isset($_POST['submit'])){
                $form->cage_area_province=trim($_POST['cage_area_province']);
                $form->cage_area_city=trim($_POST['cage_area_city']);
                $form->cage_area_county=trim($_POST['cage_area_county']);
                $form->cage_area_town=trim($_POST['cage_area_town']);
                $form->cage_number=trim($_POST['cage_number']);
                $form->cage_lng=trim($_POST['cage_lng']);
                $form->cage_lat=trim($_POST['cage_lat']);
                $form->cage_depth=trim($_POST['cage_depth']);
                $form->tide_range=trim($_POST['tide_range']);
                $form->tide_high_direction=trim($_POST['tide_high_direction']);
                $form->tide_slow_direction=trim($_POST['tide_slow_direction']);
                $form->velocity_max=trim($_POST['velocity_max']);
                $form->velocity_min=trim($_POST['velocity_min']);
                $form->closest_distance=trim($_POST['closest_distance']);
                $form->surface_type=trim($_POST['surface_type']);
                if($form->validate()) {
                    if (User::area([
                        'id'=>$model->id,
                        'cage_area_province'=>$form->cage_area_province,
                        'cage_area_city'=>$form->cage_area_city,
                        'cage_area_county'=>$form->cage_area_county,
                        'cage_area_town'=>$form->cage_area_town,
                        'cage_number'=>$form->cage_number,
                        'cage_lng'=>$form->cage_lng,
                        'cage_lat'=>$form->cage_lat,
                        'cage_depth'=>$form->cage_depth,
                        'tide_range'=>$form->tide_range,
                        'tide_high_direction'=>$form->tide_high_direction,
                        'tide_slow_direction'=>$form->tide_slow_direction,
                        'velocity_max'=>$form->velocity_max,
                        'velocity_min'=>$form->velocity_min,
                        'closest_distance'=>$form->closest_distance,
                        'surface_type'=>$form->surface_type,
                    ])) {
                        Yii::$app->session->setFlash(Variable::$session_success, '数据更新成功');
                    }
                    else{
                    Yii::$app->session->setFlash(Variable::$session_error,'数据更新失败，请重试');
                    }
                }
            }
            else{
                $model= User::getUserInfo($this->user_id);
                $form->cage_area_province=$model->cage_area_province;
                $form->cage_area_city=$model->cage_area_city;
                $form->cage_area_county=$model->cage_area_county;
                $form->cage_area_town=$model->cage_area_town;
                $form->cage_number=$model->cage_number;
                $form->cage_lng=$model->cage_lng;
                $form->cage_lat=$model->cage_lat;
                $form->cage_depth=$model->cage_depth;
                $form->tide_range=$model->tide_range;
                $form->tide_high_direction=$model->tide_high_direction;
                $form->tide_slow_direction=$model->tide_slow_direction;
                $form->velocity_max=$model->velocity_max;
                $form->velocity_min=$model->velocity_min;
                $form->closest_distance=$model->closest_distance;
                $form->surface_type=$model->surface_type;
            }
            return $this->render(pageUrl::$user_area,['form'=>$form]);
        }
        public function actionCulture(){
            $model= User::getUserInfo($this->user_id);
            if(empty($model)){
                $this->redirect(pageUrl::$login);
                return;
            }
            $form=new UserForm();
            $form->scene='culture';
            if(isset($_POST['submit'])){
                $form->culture_type=trim($_POST['culture_type']);
                $form->feedstuff_type=trim($_POST['feedstuff_type']);
                $form->feed_type=trim($_POST['feed_type']);
                $form->feed_count=trim($_POST['feed_count']);
                if($form->validate()) {
                    if (User::culture([
                        'id'=>$model->id,
                        'culture_type'=>$form->culture_type,
                        'feedstuff_type'=>$form->feedstuff_type,
                        'feed_type'=>$form->feed_type,
                        'feed_count'=>$form->feed_count,
                    ])) {
                        Yii::$app->session->setFlash(Variable::$session_success, '数据更新成功');
                    }
                    else{
                        Yii::$app->session->setFlash(Variable::$session_error,'数据更新失败，请重试');
                    }
                }
            }
            else {
                $model = User::getUserInfo($this->user_id);
                $form->culture_type = $model->culture_type;
                $form->feedstuff_type = $model->feedstuff_type;
                $form->feed_type = $model->feed_type;
                $form->feed_count = $model->feed_count;
            }
            return $this->render(pageUrl::$user_culture,['form'=>$form]);
        }
        public function actionManger(){
            $model= User::getUserInfo($this->user_id);
            if(empty($model)){
                $this->redirect(pageUrl::$login);
                return;
            }
            $form=new UserForm();
            $form->scene='manger';
            if(isset($_POST['submit'])){
                $form->cage_manger_name=trim($_POST['cage_manger_name']);
                $form->cage_manger_age=trim($_POST['cage_manger_age']);
                $form->cage_manger_work_age=trim($_POST['cage_manger_work_age']);
                $form->cage_manger_education=trim($_POST['cage_manger_education']);
                $form->cage_manger_mobile=trim($_POST['cage_manger_mobile']);
                if($form->validate()) {
                    if (User::manger([
                        'id'=>$model->id,
                        'cage_manger_name'=>$form->cage_manger_name,
                        'cage_manger_age'=>$form->cage_manger_age,
                        'cage_manger_work_age'=>$form->cage_manger_work_age,
                        'cage_manger_education'=>$form->cage_manger_education,
                        'cage_manger_mobile'=>$form->cage_manger_mobile,
                    ])) {
                        Yii::$app->session->setFlash(Variable::$session_success, '数据更新成功');
                    }
                    else{
                        Yii::$app->session->setFlash(Variable::$session_error,'数据更新失败，请重试');
                    }
                }
            }
            else {
                $model = User::getUserInfo($this->user_id);
                $form->cage_manger_name = $model->cage_manger_name;
                $form->cage_manger_age = $model->cage_manger_age;
                $form->cage_manger_work_age = $model->cage_manger_work_age;
                $form->cage_manger_education = $model->cage_manger_education;
                $form->cage_manger_mobile = $model->cage_manger_mobile;
            }
            return $this->render(pageUrl::$user_manger,['form'=>$form]);
        }
        public function actionManufacturer(){
            $model= User::getUserInfo($this->user_id);
            $list=Manufacturer::find()->where(['add_user'=>$model->id])->all();
            return $this->render(pageUrl::$user_manufacturer,['list'=>$list]);
        }
        public function actionCagegroup(){
            return $this->render(pageUrl::$user_cagegroup);
        }
        public function actionFeedstuff(){
            return $this->render(pageUrl::$user_feedstuff);
        }
        public function actionAdd_mf(){
            $model= User::getUserInfo($this->user_id);
            if(empty($model)){
                $this->redirect(pageUrl::$login);
                return;
            }
            $id=intval(trim($_GET['id']));
            $form = new ManufacturerForm();
            $form->scene = 'add_mf';
            if (isset($_POST['submit'])) {
                    $form->name = trim($_POST['name']);
                    $form->address = trim($_POST['address']);
                    $form->mobile = trim($_POST['mobile']);
                    $form->contracts_name = trim($_POST['contracts_name']);
                    $form->contracts_mobile = trim($_POST['contracts_mobile']);
                    $form->type = trim($_POST['type']);
                    if ($form->validate()) {
                        if (Manufacturer::saveOne([
                            'id' => $id,
                            'name' => $form->name,
                            'address' => $form->address,
                            'mobile' => $form->mobile,
                            'contracts_name' => $form->contracts_name,
                            'contracts_mobile' => $form->contracts_mobile,
                            'type' => $form->type,
                            'add_user' => $this->user_id,
                        ])
                        ) {
                            Yii::$app->session->setFlash(Variable::$session_success, '数据添加成功');
                            $this->redirect(pageUrl::$user_manufacturer);
                        } else {
                            Yii::$app->session->setFlash(Variable::$session_error, '数据添加失败，请重试');
                        }
                    }
                }
            else{
                if(isset($id)){
                    $model=Manufacturer::findOne($id);
                    $form->name=$model->name;
                    $form->address=$model->address;
                    $form->mobile=$model->mobile;
                    $form->contracts_name=$model->contracts_name;
                    $form->contracts_mobile=$model->contracts_mobile;
                    $form->type=$model->type;
                }
            }
            $url=pageUrl::$user_add_mf;
            if($id){
                $url=pageUrl::$user_add_mf.'?id='.$id;
            }
            return $this->render(pageUrl::$user_add_mf,['form'=>$form,'url'=>$url]);
        }
        public function actionAdd_fs(){
            return $this->render(pageUrl::$user_add_fs);
        }
        public function actionAdd_cg(){
            return $this->render(pageUrl::$user_add_cg);
        }
        public function actionAdd_c(){
            return $this->render(pageUrl::$user_add_c);
        }
        public function actionCage_list(){
            return $this->render(pageUrl::$user_cage_list);
        }
    }