<?php
    $title='叮叮功课';
    if($msg->title){
        $title=$msg->title;
    }
    $message='出错啦~';
    if($msg->message){
        $message=$msg->message;
    }
    $buttonLabel='返回首页';
    if($msg->buttonLabel){
        $buttonLabel=$msg->buttonLabel;
    }
    $backUrl=\common\widgets\pageUrl::$home;
    if($msg->backUrl){
        $backUrl=$msg->backUrl;
    }
?>
<?=$this->render('/layouts/default_header',['type'=>'default','backUrl'=> $backUrl,'title'=>$title]);?>
<div class="error">
    <p class="error-img"><img src="/img/payfail.png" /></p>
    <p class="error-info"><?=$message?></p>
    <a href="<?= $backUrl;?>" class="error-a click-btn"><?=$buttonLabel?></a>
</div>
<?php $this->beginBlock('page') ?>
    $(function(){
    if(window!=top){
    top.window.location.href=window.location.href;
    }
    });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['page'], \yii\web\View::POS_END); ?>