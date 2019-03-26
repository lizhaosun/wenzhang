<?php


namespace app\index\controller;
use app\common\controller\Base;
use think\facade\Request;
use app\common\model\User as UserModel;
use think\facade\Session;



class User extends Base
{
    //注册页面
    public function register(){
        //检测是否开启注册
        $this->is_reg();

        $this->assign('title','用户注册');

        return $this->fetch();
    }
    //处理用户提交的注册信息
    public function insert(){

        if(Request::isAjax()){
            $data=Request::post();

            $rule='app\common\validate\User'; //自定义验证器规则
            //开始验证
            $res=$this->validate($data,$rule);
            if(true!==$res){//假如验证失败
                return['status'=>-1,'message'=>$res];
            }else{//假如验证通过
                if($user=UserModel::create($data)){
                    //halt($user);
                    //实现自动登录功能
                    $res=UserModel::get($user->id);

                    Session::set('user_id',$res->id);
                    Session::set('user_name',$res->name);

                    return ['status'=>1,'message'=>'恭喜,注册成功'];
                }else{
                    return ['status'=>0,'message'=>'注册失败'];
                }
            }
        }else{

            $this->error("请求类型错误",'register');
        }
    }
       /* $data=Request::post();
        dump($data);
        if(is_array($data)){
            //使用模型创建数据
            //获取用户通过表单提交过来的数据
            //$data=Request::except('password_confirm','post');
            //$data=Request::post();
            if(UserModel::create($data)){
                dump('ok');
                return ['status'=>1,'message'=>'恭喜,注册成功'];
            }else{
                dump('no');
                return ['status'=>0,'message'=>'注册失败'];
            }
        }else{
            $this->error("请求类型错误",'register');
        }*/

//用户登录
public function login(){

    $this->logined();
    return $this->view->fetch('login',['title'=>'用户登录']);
}

//用户登录验证与查询
public function loginCheck()
{Session::clear();
    if (Request::isAjax()) {
        $data = Request::post();
        $rule = [
            'email|邮箱' => 'require|email',
            'password|密码' => 'require|alphaNum'
        ]; //自定义验证器规则
        //开始验证
        $res = $this->validate($data, $rule);
        if (true !== $res) {//假如验证失败
            return ['status' => -1, 'message' => $res];
        } else {
            //执行查询
            $result = UserModel::get(function ($query) use ($data) {
                $query->where('email', $data['email'])
                    ->where('password', sha1($data['password']));
            });
            if (null == $result) {
                return ['status' => 0, 'message' => '邮箱或者密码不正确'];
            } else {
                //将用户的数据写到session
                Session::set('user_id', $result->id);
                Session::set('user_name', $result->name);
                Session::set('is_admin', $result->is_admin);

                return ['status' => 1, 'message' => '登录成功'];
            }
        }
    } else {

        $this->error("请求类型错误", 'login');
    }
}

public function logout(){
    Session::clear();
/*    Session::delete('user_id');
    Session::delete('user_name');
    Session::delete('is_admin');*/
    $this->success('退出登录成功','index/index');
}
}