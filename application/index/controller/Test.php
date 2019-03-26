<?php
/**
 *测试专用控制器
 */

namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\User;
class Test extends Base
{
    //测试用户的验证器
    public function test1(){

    $data=[
            'name'=>'peterwu',
            'email'=>'sun@qq.com',
            'mobile'=>'15875463254',
            'password'=>'123aaa',

        ];
        $rule='app\common\validate\User';
        return  $this->validate($data,$rule);
}
    public function test2(){
        dump(User::get(110));
    }
    //post
/*$.ajax({
    //几个参数需要注意一下
type: "POST",//方法类型
dataType: "json",//预期服务器返回的数据类型
url: "/users/login" ,//url
data: $('#form1').serialize(),
success: function (result) {
    console.log(result);//打印服务端返回的数据(调试用)
    if (result.resultCode == 200) {
        alert("SUCCESS");
    }
    ;
},
error : function() {
    alert("异常！");
}
});
}*/
//get
/*$(function(){
 3 　　$('#send').click(function(){
 5 　　$.ajax({
 7 　　type: "GET",
 9 　　url: "test.json",
11 　　data: {username:$("#username").val(), content:$("#content").val()},
13 　　dataType: "json",
15 　　        success: function(data){
17 　　       $('#resText').empty(); //清空resText里面的所有内容
19 　       　var html = '';
21 　       　$.each(data, function(commentIndex, comment){
23 　　          html += '' + comment['username']+ ':+ '';
24            });
26 　          　$('#resText').html(html);
28 　         　}
30 　　});
32 　　         });
34 　　});*/
}