$(function(){
    new FastClick(document.body);
    var bodyHeight = $(document).height();
    echo.init({
        offset: 0,
        throttle: 0
    });
    Global.UI.showButtonClickStatus();
    $("#ddgk").css("min-height",bodyHeight);
})

/* 显示遮罩层 */
var showOverlay=function() {
    $("#overlay").removeClass('overlay-hide').addClass('overlay-show');
    $("#asideMenu").removeClass('aside-menu-hide').addClass('aside-menu-show');
}
/* 隐藏覆盖层 */
var hideOverlay=function() {
    $("#overlay").removeClass('overlay-show').addClass('overlay-hide');
    $("#asideMenu").removeClass('aside-menu-show').addClass('aside-menu-hide');
}
/***选择城市***/
var selectCity=function(){
$("#citylistUl li").click(function(){
    $(this).addClass("selected").siblings().removeClass("selected");
    $("#citylistUl li").children(".icon-check").remove();
    $(this).prepend('<img src="/img/icon-check.png" class="icon-check" />');
});
};
/***注册角色选择***/
var selectUserRole=function(){
    var fn=function(obj,index){
        $("#formRole > div > div").animate({"border":"1px solid #dcdcdc","color":"#777"},1);
        $("#formRole > div").eq(0).children("div").find("img").prop("src","/img/icon-zcjz.png");
        $("#formRole > div").eq(1).children("div").find("img").prop("src","/img/icon-zcls.png");
        $("#formRole > div").eq(2).children("div").find("img").prop("src","/img/icon-zcfd.png");
        //var index = $(this).index();
        switch (parseInt(index)){
            case 0:
                $(obj).children("div").animate({"border":"1px solid #80afff","color":"#80afff"},1);
                $(obj).children("div").find("img").prop("src","/img/icon-zcjzed.png");
                break;
            case 1:
                $(obj).children("div").animate({"border":"1px solid #80afff","color":"#80afff"},1);
                $(obj).children("div").find("img").prop("src","/img/icon-zclsed.png");
                break;
            case 2:
                $(obj).children("div").animate({"border":"1px solid #80afff","color":"#80afff"},1);
                $(obj).children("div").find("img").prop("src","/img/icon-zcfded.png");
                break;
            default :
                break
        }

        $("#formRole").attr('data-role',index);
    }
    var index = Global.Core.getRequestUrlParam('type');
    var obj=false;
    if(index){
        obj= $("#formRole > div").eq(index);
        fn(obj,index);
    }

        $("#formRole > div").click(function(){
            obj=this;
            var a = $(this).index();
            fn(obj,a);
        })
}
//获取验证码
var  getPhoneCode=function(obj,verify_type){
    var mobile= Global.Core.trimString($('#mobile').val());
    if(!Global.Core.checkMobileIsOk(mobile)){
        //Global.Core.layerMsgAlert('手机号不符合规范');
        Global.Alert.show('手机号不符合规范',1,10);
        return;
    }
    var cd=new countDown();
    cd.time=45;
    cd.obj=document.getElementById('getphonecode');
    cd.beginCountDown();
    var sju=Math.random();
    //var ind= Global.Core.layerLoadingAlert('正在发送请求...');
    $.post('/site/getverifycode',{mobile:mobile,sju:sju,'verify_type':verify_type},function(data){
        //Global.Core.layerCloseByObj(ind,0.5);
        switch (data.status){
            case '_0000':
                Global.Alert.show('短信下发成功，请注意查收',0,10);
                //Global.Core.layerMsgAlert('短信下发成功，请注意查收',1);
                break;
            default:
                cd.stopCountDown();
                Global.Alert.show(data.message,1,10);
                //Global.Core.layerMsgAlert(data.message);
                break;
        }
    },'json');
}

/*用户注册*/
var submitRegisterClick=function(obj){
    var type=parseInt(Global.Core.trimString($("#formRole").attr('data-role')));
    var mobile= Global.Core.trimString($('#mobile').val());
    var verifyCode=Global.Core.trimString($("#verifyCode").val());
    var password=Global.Core.trimString($("#password").val());
    if(isNaN(type)){
        Global.Alert.show('请选择注册用户的角色',1,1110);
        return;
    }
    if(!Global.Core.checkMobileIsOk(mobile)){
        Global.Alert.show('手机号不符合规范',1,10);
        return;
    }
    if(!verifyCode){
        Global.Alert.show('请输入验证码',1,10);
        return;
    }
    if(!Global.Core.checkPassWordIsOk(password)){
        //Global.Core.layerMsgAlert('请输入6~30位密码');
        Global.Alert.show('请输入6~30位密码',1,10);
        return;
    }
    Global.Alert.close();
    var ind=Global.Loading.show(obj,'加载中...');
    //var ind= Global.Core.layerLoadingAlert('正在发送请求...');
    $.post('/site/regbymobile',{'type':type,'mobile':mobile,'verifyCode':verifyCode,'password':password},function(json){
        Global.Loading.close(ind);
        //l.stop()
        //Global.Core.layerCloseByObj(ind,0.5);
        if(json){
            if(json.status=='_0000'){
                //Global.Core.layerMsgAlert('注册成功');
                Global.Core.locationToUrlByTime(json.message,1);
                return;
            }
            else{
                //Global.Core.layerMsgAlert(json.message);
                Global.Alert.show(json.message,1,10);
                return;
            }

        }
        //Global.Core.layerMsgAlert('注册失败，请刷新重试');
        Global.Alert.show('注册失败，请刷新重试',1,10);
        return;
    },'json');
}
/*重置密码*/
var submitResetPwdClick=function(obj){
    var mobile= Global.Core.trimString($('#mobile').val());
    var verifyCode=Global.Core.trimString($("#verifyCode").val());
    var password=Global.Core.trimString($("#password").val());
    if(!Global.Core.checkMobileIsOk(mobile)){
        Global.Alert.show('手机号不符合规范',1,10);
        return;
    }
    if(!Global.Core.checkPassWordIsOk(password)){
        Global.Alert.show('请输入6~30位密码',1,10);
        return;
    }
    //var ind= Global.Core.layerLoadingAlert('正在发送请求...');
    var ind=Global.Loading.show(obj,'加载中...');
    $.post('/site/submitresetpwd',{'mobile':mobile,'verifyCode':verifyCode,'password':password},function(json){
        Global.Loading.close(ind);
        //Global.Core.layerCloseByObj(ind,0.5);
        if(json){
            if(json.status=='_0000') {
                Global.Alert.show("密码重置成功，正跳转到登陆页面..", 0, 10);
                Global.Core.locationToUrlByTime('/site/login', 3);
                return;
            }
            else{
                Global.Alert.show(json.message,1,10);
                return;
            }
        }
        Global.Alert.show('密码重置失败，请刷新重试',1,10);
        return;
    },'json');
}

/*首页app下载弹出*/
var appScroll=function(){
   var indexHeight = $("#indexHead").height();
    $(window).on('scroll',function(){
        var top = document.body.scrollTop;
        if(top>indexHeight){
            $("#download").addClass("active");
        }else{
            $("#download").removeClass("active");
        }

    });
    $("#dowloadClose").click(function(){
        $("#download").hide();
    })
}
/*首页二维码弹出*/
var codeShow=function(){
    $("#weixin").click(function(){
        $("#codeShare").show();
        $("#indexCode").show();
        $("#download").hide();
        $("#enrollBtn").hide();
    });
    $("#codeShare").click(function(){
        $("#codeShare").hide();
        $("#indexCode").hide();
        $("#download").show();
        $("#enrollBtn").show();
    });
}
/*按钮背景颜色改变*/
var changeBgColor = function(id){

    $(id).click(function(){
        if(this.clicked){
            //this.removeAttribute('clicked');
            return true;
        }
        var t = $(this);
        $(this).css("background-color","#648ed5");
        this.clicked = true;
        var tt = this;

        setTimeout(function(){
            if(tt.nodeName == 'A'){
                location.href = tt.href;
            }else{
                t.click();
            }
        },100);

        return false;

    })
}
