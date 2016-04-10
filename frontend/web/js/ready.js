/**
 * Created by 顾家进
 * User: jaybril
 * Date: 2016/3/4 0004
 * Time: 下午 3:17
 * info:
 */
var G_DATA_SELECT_VALUE='data-select-value';//select下拉框默认值

window.onload = function () {
        render_select();
    };

/*设置select渲染值*/
var render_select=function(fn){
    var list=document.getElementsByTagName('select');
    for(var k=0;k<list.length;k++){
        var self=list[k];
        var attr_list=self.attributes;
        var has=false;
        for(var i=0;i<attr_list.length;i++){
            //console.log(i);
            if(attr_list[i]["name"]==G_DATA_SELECT_VALUE){
                has=true;
                break;
            }
        }
        if(!has){
            return;
        }
        var value= self.getAttributeNode(G_DATA_SELECT_VALUE).value;
        var options=self.options;
        for(var i=0;i<options.length;i++){
            var cur_opt=options[i];
            if(value==cur_opt.value){
                self.options[i].setAttribute('selected','selected');
                break;
            }
        }
    }
    //fn(self,func);
}