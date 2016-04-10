/*
*Global.js 全局文件，封装基础函数和工具函数
*使用方式：Global.函数名() 如-Global.static.checkIsMoneyStr()
*
* stringFormatToDate(s)-把字符串格式化成日期对象
* isEmptyObject(obj)-判断json对象是否为空
* getCharLength(str)-返回字符串长度
* trimString(str)-去掉字符串首尾的空格
* checkStringIsChinese(str)-判断字符串是否为中文
* checkIsNumberStr(str)-检查str是否是纯数字组成的
* checkIsMoneyStr(str)-校验字符串是否为合法的钱数（小数点后两位）
* checkStringIsInArray(ar,s)-查找s是否在数组中，注意s的类型和数组的类型尽量一致
* checkCookieIsExist(n)-检测是否有cookie
* setCookie(name,value,time)-设置一个cookie
* getCookie(name)-取得指定cookie的值
* delCookie(name)-删除指定的cookie
* checkMobileIsOk(tel)-验证手机号码的有效性
* checkPassWordIsOk(pwd)-检查密码是否是符合要求（6-30位）
* checkRealNameIsOk(realName)-检查真实姓名是否是符合要求
* checkEmailIsOk(email)-检查邮箱是否是符合要求
* locationToUrlByTime(url,timeout)-页面跳转
* getRequestUrlParam(paras)-获取URL地址的参数
* pageRefreshByTime(timeout)-页面刷新
* reloadCaptchaByThis(obj)-给当期节点重新请求验证码
* reloadCaptchaById(objId)-给某个id节点重新请求验证码
* checkIdCardIsOk(str)-验证身份证号码是否真实有效
* layerMsgAlert（tips,time）-弹出层：信息框
* layerTipsAlert（tips,time）-弹出层：提示框
* layerLoadingAlert（content）-弹出层：加载框
* layerCloseByObj（obj,timeout）-弹出层：关闭指定的弹层
* layerCloseAll（ timeout）-弹出层：关闭所有弹层
*/
var Global={};//全局对象
//核心基本js函数
Global.Core=(function(){
    var res = {
        version : "1.0.0", //版本
        parentClass:"zepto.js,layer.js",//依赖的基础库
        lastModify:"",//最后修改时间
        copyRight:"dingdinggongke",//版权所有
        author:"Gujiajin",//作者
        //-----------------------------
        //名称：stringFormatToDate(s)
        //功能：把字符串格式化成日期对象
        //------------------------------
       stringFormatToDate: function(s){
           s=typeof s=="number"?s+"":s;
           if (typeof(s) == "string") {
               $.trim(s);
               s = s.replace(/[\/\s\:]/gi, "-");
               if(s.length<4){
                   return false;
               }
               if (s.match(/\-/)!=null) {
                 var  md = s.split("-");
                   md[1] = md[1] * 1 - 1;
                   if (md.length > 3) {
                       s = new Date(md[0], md[1], md[2], md[3], md[4], md[5])
                   }
                   else {
                       s = new Date(md[0], md[1], md[2]);
                   }
               }
               else {
                   md = s.split("");
                   var mdy = ("" + md[0] + md[1] + md[2] + md[3]) * 1;
                   var mdm = ("" + md[4] + md[5]) * 1 - 1;
                   var mdd = ("" + md[6] + md[7]) * 1;
                   if (md.length > 10) {
                       var mdhh = ("" + md[8] + md[9]) * 1;
                       var mdmm= ("" + md[10] + md[11]) * 1;
                       var mdss = ("" + md[12] + md[13]) * 1;
                       s = new Date(mdy, mdm, mdd, mdhh, mdmm, mdss);
                   }
                   else {
                       s = new Date(mdy, mdm, mdd);
                   }
               }
           }
           return s;
    },
    //-----------------------------
        //名称：isEmptyObject(obj)
        //功能：判断json对象是否为空
        //------------------------------
        isEmptyObject:function(obj){
                var name;
                for ( name in obj ) {
                    return false;
                }
                return true;
        },
        //-----------------------------
        //名称：getCharLength(str)
        //功能：返回字符串长度
        //------------------------------
        getCharLength:function(str){
        var strLength=0;
        for (i=0;i<str.length;i++)
        {
            if (this.checkStringIsChinese(str.charAt(i))==true){
                strLength=strLength + 2;
            }
            else{
                strLength=strLength + 1;
            }
        }
        return strLength;
    },
        //-----------------------------
        //名称：checkStringIsDate(str)
        //功能：检查字符串是否是时间格式（y-m-d）
        //返回值:string
        //------------------------------
        checkStringIsDate :function(str){
            if(!/^(\d{4})\-(\d{1,2})\-(\d{1,2})$/.test(str))
                return false;
            var year = RegExp.$1-0;
            var month = RegExp.$2-1;
            var date = RegExp.$3-0;
            var obj = new Date(year,month,date);
            return !!(obj.getFullYear()==year && obj.getMonth()==month && obj.getDate()==date);
        },
        //-----------------------------
        //名称：trimString(str)
        //功能：去掉字符串首尾空格
        //返回值:string
        //------------------------------
        trimString :function(str){
            if(str) {
                str=str.toString();
                return str.replace(/(^\s*)|(\s*$)/g, "")
            }
            return str
        },
        //-----------------------------
        //名称：checkStringIsChinese(str)
        //功能：判断字符串是否为中文
        //返回值:TRUE-是中文  FALSE-不是中文
        //------------------------------
       checkStringIsChinese :function(str){
        var badChar ="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        badChar += "abcdefghijklmnopqrstuvwxyz";
        badChar += "0123456789";
        badChar += " "+"　";//半角与全角空格
        badChar += "`~!@#$%^&*()-_=+]\\|:;\"\\'<,>?/";//不包含*或.的英文符号
        if(""==str){
            return false;
        }
        for(var i=0;i<str.length;i++){
            var c = str.charAt(i);//字符串str中的字符
            if(badChar.indexOf(c) > -1){
                return false;
            }
            return true;
        }
    },
        //-----------------------------
        //名称：checkIsNumberStr(str)
        //功能：检查str是否是纯数字组成的
        //参数：str
        //返回值:TRUE-校验通过  FALSE-校验不通过
        //------------------------------
        checkIsNumberStr:function(str){
            var patrn=/^[0-9]+$/;
            return patrn.test(str);
        },
        //-----------------------------
        //名称：checkIsMoneyStr(str)
        //功能：校验字符串是否为合法的钱数（小数点后两位）
        //参数：str-字符串
        //返回值:true-校验通过 fasle-校验不通过
        //------------------------------
         checkIsMoneyStr:function(str){
            if(!str){
                return false;
            }
            var regx=/^(([1-9]\d*)|0)(\.\d{1,2})?$/;
            if(regx.test(str)){
                return true;
            }
            else{
                return false;
            }
        },
        //-----------------------------
        //名称：checkStringIsInArray(ar,s);
        //功能：查找s是否在数组中，注意s的类型和数组的类型尽量一致
        //参数：S类型和数组元素类型一致
        //返回值:s在数组中的元素下标，-1为没找到
        //------------------------------
        checkStringIsInArray:function(ar,s){
        var l=ar.length;
        for(var i=0;i<l;i++){
            if(ar[i]==s){return i;}
        }
        return -1;
    },
        //-----------------------------
        //名称：checkCookieIsExist(n)
        //功能：检测是否有cookie
        //参数：n,cookie的名称
        //返回值:bool
        //------------------------------
       checkCookieIsExist:function(n){
        var r=new RegExp(n+"=[^;]*","gi");
        var m=document.cookie.match(r);
        if(!m){return false;}else{return true;}
    },
        //-----------------------------
        //名称：setCookie(name,value,time)
        //功能：设置一个cookie
        //参数：名称，值，过期时间d天，
        //返回值:
        //------------------------------
        setCookie:function(n,v,d){
        var exp="";
        if(typeof d=="number"){
            var dt=new Date();
            dt.setTime(dt.getTime()+d*24*60*60*1000);
            exp=";Expires="+dt.toGMTString();
        }
        document.cookie=n+"="+escape(v)+exp;
    },
        //-----------------------------
        //名称：getCookie(name)
        //功能：取得指定cookie的值
        //参数：
        //返回值:
        //------------------------------
        getCookie:function(n){
        var r=new RegExp(n+"=[^;]*","gi");
        var m=document.cookie.match(r);
        if(!m){return "";}else{
            return unescape(m[0].split("=")[1]);
        }
    },
        //-----------------------------
        //名称：delCookie(name)
        //功能：删除指定的cookie
        //参数：
        //返回值:
        //------------------------------
        delCookie:function(n){
        var r=new RegExp(n+"=[^;]*","gi");
        var m=document.cookie.match(r);
        if(!m){return "";}else{
            var dt=new Date();
            document.cookie=n+"=;Expires="+dt.toGMTString();
        }
        },
        //-----------------------------
        //名称：checkMobileIsOk(tel)
        //验证手机号码的有效性
        //参数： tel-要检验的手机号码
        //返回值:TRUE-校验通过  FALSE-不通过 手机号码格式不合法
        //------------------------------
        checkMobileIsOk:function(tel){
            var reg = /1[3-8]+\d{9}/;
            if(reg.test(tel)){
                return true;
            }
            return false;
        },
        //-----------------------------
        //名称：checkPassWordIsOk(pwd)
        //功能：检查密码是否是符合要求（6-30位）
        //参数 pwd-密码
        //返回值:TRUE-校验通过  FALSE-校验不通过
        //------------------------------
        checkPassWordIsOk:function(pwd) {
            var patrn = /^\S{6,30}$/;
            if(!pwd){
                return false;
            }
            if(!patrn.test(pwd)){
                return false;
            }
            return true;
        },
        //-----------------------------
        //名称：checkRealNameIsOk(realName)
        //功能：检查真实姓名是否是符合要求
        //参数 realName-真实姓名
        //返回值:TRUE-校验通过  FALSE-校验不通过
        //------------------------------
        checkRealNameIsOk:function(realName) {
            var reg="^[\u4e00-\u9fa5]{0,}$";
            if(realName!=""&&realName.length>1){
                if(realName.match(reg)){
                    return true;
                }else{
                    return false;
                }
            }else {
                return false;
            }
        },
        //-----------------------------
        //名称：checkEmailIsOk(email)
        //功能：检查邮箱是否是符合要求
        //参数 email-邮箱
        //返回值:TRUE-校验通过  FALSE-校验不通过
        //------------------------------
        checkEmailIsOk:function(email){
        if(email.length>0){
            reg=/^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;
            if(!reg.test(email)){
                return false;
            }else{
                return true;
            }
        }
        return false;
    },
        //-----------------------------
        //名称：locationToUrlByTime(url,timeout)
        //功能：页面跳转
        //参数： url-要跳转到的页面;timeout-等待时间
        //返回值:
        //------------------------------
        locationToUrlByTime:function(url,timeout){
            //if(!url) {
            //    url = window.location.href;
            //
            //}
            if(isNaN(parseFloat(timeout))){
               timeout=0;
            }
            timeout=timeout*1000;
            setTimeout(function(){
                if(!url){
                    location.reload();
                }
                window.location.href=url;
            },timeout);
          },
        //名称：getRequestUrlParam(paras)
        //功能：获取URL地址的参数
        //参数：paras-参数名
        //返回值:参数值
        //------------------------------
        getRequestUrlParam:function(paras){
            var url = location.href;
            var paraString = url.substring(url.indexOf("?")+1,url.length).split("&");
            var paraObj = {}
            for (i=0; j=paraString[i]; i++){
                paraObj[j.substring(0,j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=")+1,j.length);
            }
            var returnValue = paraObj[paras.toLowerCase()];
            if(typeof(returnValue)=="undefined"){
                return "";
            }else{
                return returnValue;
            }
        },
        //-----------------------------
        //名称：pageRefreshByTime(timeout)
        //功能：页面刷新
        //参数： timeout-等待时间
        //返回值:
        //------------------------------
        pageRefreshByTime:function(timeout){
            if(parseInt(timeout)){
                setTimeout(function(){
                    window.location.reload();
                },timeout);
                return;
            }
            window.location.reload();
        },
        //-----------------------------
        //名称：reloadCaptchaByThis(obj)
        //功能：给当期节点重新请求验证码
        //参数：obj-当前节点 this
        //返回值:
        //------------------------------
        reloadCaptchaByThis:function(obj){
            if(!obj){
                obj='checkcode_img';
            }
            obj.src="/inc/code_char.php"+"?t="+new Date().getTime();
        },
        //-----------------------------
        //名称：reloadCaptchaById([])
        //功能：给某个id节点重新请求验证码
        //参数：obj-节点的id值
        //返回值:
        //------------------------------
        reloadCaptchaById:function(obj){
        if(!obj){
            obj='Captcha';
        }
        document.getElementById(obj).src="/inc/code_char.php"+"?t="+new Date().getTime();
    },
        //-----------------------------
        //名称：checkIdCardIsOk([])
        //功能：验证身份证号码是否符合格式
        //参数：IDCardNo-身份证号码
        //返回值:1-校验通过 其他-校验不通过
        //------------------------------
        checkIdCardIsOk:function(IDCardNo) {
        IDCardNo= IDCardNo.toUpperCase();
        var isMatch = (/^(\d{17})([0-9]|X)$/.test(IDCardNo));
        if (isMatch) {
            var cityNo=IDCardNo.substr(0, 2);
            //城市代码是否符合要求
            if (this.checkCityNo(cityNo)) {
                var   bstr= IDCardNo.substr(6, 8) ;
                var nowdate=new Date();
                var _bir = new Date(bstr.substring(0,4),bstr.substring(4,6),bstr.substring(6,8));
                var _agen = nowdate-_bir;
                var _age = Math.round(_agen/(365*24*60*60*1000));
                //出生日期是否符合要求
                if (_age) {
                    //控制年龄大于18周岁
                    //if (_age>=18) {
                        var factor=[7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];//加权因子
                        var checktable=[1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2];//校验值对应表
                        var checksum = 0;
                        var befor17= IDCardNo.substr(0,17);
                        for(var i=0; i<17; i++) {
                            var num=parseInt(befor17.substr(i,1) )*factor[i];
                            checksum+=num;
                        }
                        var yushu=checksum%11;
                        //余数只可能有0 1 2 3 4 5 6 7 8 9 10这11个数字
                        if (yushu>10) {
                            return '您输入的身份证不符合要求';
                        }else{
                            var s=checktable[yushu];
                            var checkNoStr= IDCardNo.substr(17, 1);
                            if (checkNoStr) {
                                //如果是“X”或者“x” 第二位  则只能对应  对应表的 10

                                if (  checkNoStr =="X"  ||  checkNoStr=="Ｘ") {
                                    if (s==10) {
                                        return 1;
                                    }else{
                                        return '您输入的身份证不符合要求';
                                    }
                                }
                                //如果不是字母，则最后一位分别对应 对应表  即可
                                else if(parseInt(checkNoStr)==s){
                                    return 1;
                                }else{
                                    return '您输入的身份证校验不通过，请检查是否是否正确';
                                }
                            }
                        }
                    //}
                    //return '国家购彩规定未满18岁不能购买彩票';
                }
                return '您输入的身份证有误，请重新输入';
            }
            return '您输入的身份证有误，请重新输入';
        }
        return '您输入的身份证有误，请重新输入';
    },
        checkCityNo:function(cityNo){
            var cityCode=["11","12","13","14","14","15","21","22","23","31","32","33","34","35","36","37","41","42","43","44","45","46","50","51","52","53","54","61","62","63","64","65","71","81","82","91"];
            for (var i=0; i<cityCode.length; i++) {
                if ( cityNo ==cityCode[i]) {
                    return true;
                }
            }
            return false;
        },
        //信息框
        layerMsgAlert:function(tips,time){
            if(parseInt(time)<1){
                time=2;
            }
            var ind=layer.open({
                type: 0,
                content:tips,
                time: time
            });
            return ind;
        },
        //提示框
        layerTipsAlert:function(title,tips,time,status){
            if(parseInt(time)<1){
                time=2;
            }
            var ind=layer.open({
                type: 0,
                title: title,
                content:tips,
                time: time
            });
            return ind;
        },
        //加载框
        layerLoadingAlert:function(content){
            var ind=layer.open({
                shadeClose:false,
                type: 2,
                content:content
            });
            return ind;
        },
        //关闭索引的弹层
        layerCloseByObj:function(obj,timeout){
            if(!Global.Core.checkIsNumberStr(timeout)){
                timeout=1;
            }
            timeout=1000*timeout;
            setTimeout(function(){
                layer.close(obj)
            },timeout);
        },
        //关闭所有弹层
        layerCloseAll:function(timeout){
            if(!Global.Core.checkIsNumberStr(timeout)){
                timeout=1;
            }
            timeout=1000*timeout;
            setTimeout(function(){
                layer.closeAll()
            },timeout);
        },
        //按钮颜色改变
        changeBtnBgColor:function(paras){
            var obj = document.getElementById(paras);
            obj.addEventListener('touchmove', function(event) {
                alert("gg");
                $(this).css("background-color","#648ed5");
            });
            obj.addEventListener('touchend', function(event) {
                $(this).css("background-color","#80afff");
            });
        }
};
    return res;    //生成公有静态元素
})();
//弹出展示层js
Global.Alert=(function(){
   var ddAlert={
       obj:document.getElementById('dd_alert'),
       content:'出错啦，请刷新重试',
       time:5,
       type:0,
       show:function(content,type,time){
           var self=this;
           this.close();
           document.body.scrollTop=0;
           if(type){
               $(self.obj).find('.fail').show();
           }
           else{
               $(self.obj).find('.success').show();
           }
           self.time=time;
           if(content){
               self.content=content;
           }
           $('#dd_alert_text').text(self.content);
           $(self.obj).removeClass('dd-alert-close-1').addClass('dd-alert-show-1');
           var p=document.getElementById('dd_alert_text').parentNode;
           $(self.obj).css('height',p.clientHeight);
           setTimeout(function(){
                    self.close();},
               self.time*1000);
            },
       close:function() {
           $(this.obj).removeClass('dd-alert-show-1').addClass('dd-alert-close-1');
           $(this.obj).css('height','0');
           $(this.obj).find('.fail').hide();
           $(this.obj).find('.success').hide();
           $('#dd_alert_text').text('');
       }
   }
    return ddAlert;
})();
//加载层js
Global.Loading=(function(){
    var ddLoading={
        obj:null,
        content:'加载中...',
        loadingClass:'ladda-loadding',
        old_text:'',
        show:function(obj,content){
            if( !obj ){
                return;
            }
            this.obj=obj;
            var l = Ladda.create(obj);
            if(content){
                this.content=content;
            }
            Global.Alert.close();
            l.start(this.content);
            $(obj).addClass(this.loadingClass);
            this.old_text= l.old_text;
            return l;
        },
        close:function(ladda){
            if( !ladda ){
                return;
            }
            ladda.stop(this.old_text);
            $(this.obj).removeClass(this.loadingClass);
        }
    };
    return ddLoading;
})();
//http请求js
Global.Request=(function(){
    var req={
        url:null,
        dataArray:{},
        method:'post',
        dataType:'json',
        async:true,
        timeSpace:1000,
        timeWait:20*1000,
        status:true,
        loadingTitle:'请求加载中...',
        request:function(url,dataArray,method,dataType,obj,title,callBack){
            var self=this;
            self.url=url ? url:this.url;
            self.dataArray=dataArray ? dataArray:this.dataArray;
            self.method=method ? method:this.method;
            self.dataType=dataType ? dataType:this.dataType;
            self.loadingTitle=title ? title :this.loadingTitle;
            if(!self.url){
                return;
            }
            var ind=null
            if(obj){
                var ind=Global.Loading.show(obj,self.loadingTitle);
            }
            var beginTime=new Date().getTime();
            $.ajax({
                    type: self.method,
                    url: self.url,
                    timeout:self.timeWait,
                    async:self.async,
                    dataType:self.dataType,
                    data:self.dataArray,
                    success:function(res,testStatus){
                        var dt=new Date().getTime() -beginTime;
                        dt=self.timeSpace-dt;
                        if(dt>self.timeWait){
                            self.status=false;
                        }
                        setTimeout(function(){
                            if(ind) {
                                Global.Loading.close(ind);
                            }
                            callBack(res,self.status)
                        },dt);
                    },
                    error:function(XMLHttpRequest,textStatus,errorThrown){
                        if(ind) {
                            Global.Loading.close(ind);
                        }
                        self.status=false;
                        callBack(false,self.status);
                    },
                    complete:function(XMLHttpRequest,textStatus){
                        if(!self.status){
                            if(ind) {
                                Global.Loading.close(ind);
                            }
                            callBack(false,self.status);
                        }
                    }
                }
            );
        }
    };
    return req;
})();
//button状态
Global.UI=(function() {
    var show = {
        buttonClickClass:'click-btn',
        buttonClickStyle:'btn-click-default-style',
        buttonClickDataName:'data-button-click-class',
        showButtonClickStatus: function (buttonClickClass,buttonClickStyle) {
            var self=this;
            self.buttonClickClass=buttonClickClass ? buttonClickClass:self.buttonClickClass;
            self.buttonClickStyle=buttonClickStyle ? buttonClickStyle:self.buttonClickStyle;
            var elements =document.getElementsByClassName(self.buttonClickClass);
            if(elements .length==0){
                return;
            }
            for(var i =0;i<=elements .length;i++ ){
                var cur_el=elements [i];
                var timeOutEvent=null;
                if( cur_el==undefined){
                    continue;
                }
                var className = $(cur_el).attr(self.buttonClickDataName);
                if (!className) {
                    className = self.buttonClickStyle;
                }

                cur_el.addEventListener('touchstart', function () {
                    $(this).addClass(className);
                    var cur=this;
                    setTimeout(function(){
                        $(cur).removeClass(className);
                    },2000);
                },false);
                cur_el.addEventListener('touchend', function () {
                        $(this).removeClass(className);
                },false);
                cur_el.addEventListener('touchmove', function () {
                    $(this).removeClass(className);
                },false);

                }

            }
    }
    return show;
})();

//function btnRemoveClass(){
//    timeOutEvent = 0;
//    $(".click-btn").removeClass("btn-click-gary-style");
//    $(".click-btn").removeClass("btn-click-default-style");
//}