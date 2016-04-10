<?php
use common\widgets\Tool;
use common\widgets\pageUrl;
$this->registerJsFile('@web/js/countDown.js',['depends'=>['frontend\assets\AppAsset']]);
?>
<script>

</script>

<div class="ddgk" id="ddgk">
    <?=$this->render('/layouts/header',['type'=>'register','backUrl'=>'/','title'=>'注册']);?>
    <div class="login-form">
        <?php
        $model=new \common\models\UserForm();
        $model=$form;
        ?>
        <form action="<?=pageUrl::$login ?>" method="post" id="login-form">
            <input type="hidden" name="submit" value="1">
            <div class="login-bg">
                <input type="text" class="form-text" placeholder="单位（个人）名称"  name="name" value="<?=$model->name?>"/>
            </div>
            <div class="login-bg">
                <input type="text" class="form-text" placeholder="单位（个人）地址"  name="address" value="<?=$model->address?>"/>
            </div>
            <div class="login-bg">
                <input type="number" class="form-text" placeholder="联系电话"  name="mobile" value="<?=$model->mobile?>" />
            </div>
            <div class="login-bg">
                <select class="form-text" name="unit_type" data-select-value="<?=$model->unit_type?>" >
                    <option value="0">请选择单位性质</option>
                    <option value="1">政府机构</option>
                    <option value="2">政府机构</option>
                    <option value="3">科研所</option>
                    <option value="4">企业</option>
                    <option value="5">个体养殖户</option>
                </select>
            </div>
            <div class="login-bg">
                <input type="password" class="form-text" placeholder="密   码" name="password" />
            </div>
            <?php
            if($model->error){
                echo ' <p class="errorTip">* '.$model->error.'</p>';
            }
            ?>
            <input type="submit" class="form-btn click-btn  ladda-button" value="下一步">
        </form>
    </div>
</div>
