<?php
use common\widgets\pageUrl;
    use common\widgets\MyCookie;
    use common\widgets\Variable;
    use common\widgets\Tool;
?>
<!--默认 start-->
<header class="header  ">
    <div class="header-left">
        <a href="<?=Tool::echoEncodeString($backUrl,pageUrl::$home)?>"><img src="/img/menureturn.png" class="header-icon-return" /></a>
    </div>
    <div class="header-center"><?=Tool::echoEncodeString($title,'网箱')?></div>
</header>
<!--默认 end-->
<?php if(Yii::$app->session->hasFlash(\common\widgets\Variable::$session_success)):?>
    <div class="dd-alert dd-alert-show-2" id="dd_alert"  >
        <div class="dd-alert-img">
            <img class="success" src="/img/error-g.png">
        </div>
        <div class="dd-alert-span">
            <span id="dd_alert_text"><?=Yii::$app->session->getFlash(Variable::$session_success)?></span>
        </div>
    </div>
<?php endif?>

<?php if(Yii::$app->session->hasFlash(Variable::$session_error)):?>
    <div class="dd-alert dd-alert-show-2" id="dd_alert"  >
        <div class="dd-alert-img">
            <img class="fail" src="/img/error-c.png">
        </div>
        <div class="dd-alert-span">
            <span id="dd_alert_text"><?=Yii::$app->session->getFlash(Variable::$session_error)?></span>
        </div>
    </div>
<?php endif?>