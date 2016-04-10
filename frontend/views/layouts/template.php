<?php
    use yii\helpers\Html;
    use frontend\assets\AppAsset;
    use common\widgets\Tool;
    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Tool::echoEncodeString($this->title,'jaybril的博客') ?></title><!--标题-->
    <meta name="keywords" content="<?=Tool::echoEncodeString($this->keywords)  ?>"><!--关键字-->
    <meta name="description" content="<?=Tool::echoEncodeString( $this->description) ?>"><!--描述-->
    <meta name="format-detection" content="telephone=no"><!--指定是否将网页内容中的手机号码显示为拨号的超链接-->
    <meta name="apple-mobile-web-app-capable" content="yes"><!--网站开启对web app程序的支持-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black"><!--在web app应用下状态条（屏幕顶部条）的颜色-->
    <meta name="apple-mobile-web-app-title" content="jaybril的博客"><!--添加到主屏后的标题-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"><!--网页缩放比-->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"><!--浏览器中地址栏左侧显示的图标-->
    <link  href="/favicon57x57.png" sizes="57x57" rel="apple-touch-icon"><!--iPhone主屏上的图标使用指定的图片-->
    <link  href="/favicon72x72.png" sizes="72x72" rel="apple-touch-icon"><!--iPhone主屏上的图标使用指定的图片-->
    <link  href="/favicon114x114.png" sizes="114x114" rel="apple-touch-icon"><!--iPhone主屏上的图标使用指定的图片-->
    <link type="image/x-icon" href="/favicon.ico" mce_href="/favicon.ico" rel="icon"><!--网页图标-->
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="container">
        <?= $content ?>
    </div>
</div>
<footer class="footer">
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
