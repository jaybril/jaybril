/*数据处理*/
var render=function(data, obj) {
    var clone = obj.find('.clone');
    //是否找到clone
    if(clone.length == 0) {
        clone = obj;
    }else{
        clone = clone[0];
    }
    //数据为一个数组
    if(data.constructor == Array){
        for(var i in data){
            var dom=$(clone.cloneNode(true));
            render(data[i], dom);
            dom.removeClass('clone');
            dom.appendTo(clone.parentNode).addClass('fadeIn');
        }
        return;
    }
    //数据为一个json或对象
    if(data.constructor == Object) {
        var isMapList  = true;//key对应的value是否为一个数组
        for(var key in data){
            isMapList = data[key].constructor == Array;
            if(!isMapList){
                break;
            }
        }
        //key对应的value是一个数组
        var key_list = $(clone).parent().find('.key');
        if(isMapList && key_list.length>0){
            loop:
                for(var key in data) {
                    if (data[key].constructor == Array) {
                            for (var i in key_list) {
                                if (i == 0)continue;
                                if (key_list[i].innerText == key) {
                                    render(data[key], $(key_list[i]).parent());
                                    continue loop;
                                }
                            }
                        var dom = $(clone.cloneNode(true));
                        dom.find('.key').text(key);
                        var value = data[key];
                        render(value, dom);

                        dom.removeClass('clone');
                        dom.appendTo(clone.parentNode);
                    }
                }
            return;
        }
        else{
            obj.find('[data-name]').each(
                function(){
                    var t = $(this);
                    var n = t.data('name');
                    var v = data[n];
                    t.data('value',v );
                }
            );
            //节点渲染
            for(var k in data){
                render_value(obj, data[k], k);

            }
            return;
        }
    }
}
/*渲染数据*/
var render_value=function(obj, data, i){
    var el=obj.find('.' + i);
    if(obj.hasClass(i)){
        //el =  obj.find('.' + i).andSelf();
        el = el.add(obj);
    }else{
        //el =  obj.find('.' + i);
    }

    //节点列表
    el.each(function(){
        /*标签渲染*/
        var fn = function(a, b, c){
            var nodName=a.nodeName || 0;
            nodName=nodName.toLocaleUpperCase();

            var $a = $(a);
            //data-gt属性 控制节点列表显示的节点范围 ：把小于data的节点隐藏
            var data_gt = $a.data('gt');
            if(data_gt){
                if(b<data_gt) {
                    $a.hide();
                }
            }
            //data-equal属性 控制节点列表显示的节点：把不等于data的节点隐藏
            var data_equal = $a.data('equal');
            if(data_equal || data_equal=='0'){
                if(data_equal != b) {
                    $a.hide();
                }
            }
            //样式替换，把样式替换成data结尾的样式
            var className = a.className.replace('_0', '_' + b);
            if(className != a.className){
                a.className = className;
            }
            //控制节点列表的的渲染：如果当前节点还存在子节点，则不直接渲染该节点
            if($a.children().length>0  &&  !$a.data('href')){
                return;
            }

            //处理数据类型为money的节点
            if($a.data('type')){
                if($a.data('type')=='money'){
                    var moneyType= parseInt($a.data('money-type'));
                    if(moneyType>0){
                        b=b/moneyType;
                    }
                    b=formatMoney(b,2,'￥');
                }
            }

            //data-hide属性 控制节点是否隐藏：把带有data-hide的节点隐藏
            if($a.data('hide')) {
                return;
            }

            if(!b && b!==0){
                return;
            }
            switch (nodName){
                case 'IMG':
                    if(a.src && a.src.indexOf('_0')>0){
                        a.src = a.src.replace('_0', '_' + b);
                    }else{
                        a.src = b;
                    }
                    break;
                case 'INPUT':
                    a.value=b;
                    break;
                case 'A':
                    var href=a.href;
                        a.href = href.replace(/=#$/g, function($0, $1){
                            return '='+b;
                        });
                    //var href = a.href.replace('_#', '_' + b);
                    //if(href != a.href){
                    //    a.href = href;
                    //}else{
                    //    a.href = b;
                    //}
                    //alert( a.href )
                    break;
                default:
                    a.innerText = b;
                    break;
            }

        };

        if(data.constructor==Array){
            for(var j in  data){
                var nel = this.cloneNode(true);
                this.parentNode.appendChild(nel);
                render(data[j],$(nel));
            }
            $(this).hide();
            return;
        }
        fn(this, data, i);
    });
}

/*formatMoney(number, places, symbol, thousand, decimal) 字符串转金钱
*@pram number  金钱字符串
*@pram places  精确位数
*@pram symbol  前面带什么符号 如￥2.00  $2.00
*@pram thousand  千分位分隔符
*@pram decimal  小数点分隔符
*/
var formatMoney=function(number, places, symbol, thousand, decimal) {
    number = number || 0;
    places = !isNaN(places = Math.abs(places)) ? places : 2;
    symbol = symbol !== undefined ? symbol : "";
    thousand = thousand || ",";
    decimal = decimal || ".";
    var negative = number < 0 ? "-" : "";
    var i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "";
    var   j = (j = i.length) > 3 ? j % 3 : 0;
    return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
}

/*数据渲染
*
* 数据结构：
*
*
*
*
*
*
*
* */
