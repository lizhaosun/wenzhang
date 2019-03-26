<?php
/*
 * 继承自app\common\Controller\Base 的公共控制器
 */
namespace app\index\controller;
use app\common\model\Article;
use app\common\model\ArtCate;
use app\common\model\PingLun;
use think\facade\Request;
use think\facade\Db;
use think\facade\Session;
use app\common\Controller\Base; //导入公共控制器
class Index extends Base
{//首页
    public function index()
    {   if(Session::has('admin_id')){
        $userId= Session::get('admin_id');
        $res= Db('think_user')->where('id',$userId)->find();
        Session::set('user_id',$res['id']);
        Session::set('user_name',$res['name']);
    }

        //全局查询条件
        $map=[];//将所有的查询条件封装到这个数组中
        //条件1:
        $map[]=['status','=',1];
        //实现搜索功能
        $keywords=Request::param('keywords');
        if(!empty($keywords)){
            //条件2
            $map[]=['title','like','%'.$keywords.'%'];

        }

      //分类信息显示
        $cateId=Request::param('cate_id');
        //如果存在这个分类id
        if(isset($cateId)){
            //条件3
            $map[]=['cate_id','=',$cateId];
            $res=ArtCate::get($cateId);
            $artList=Article::where($map)
                ->order('create_time','desc')
                ->paginate(4);
            $this->view->assign('cateName',$res->name);
        }else{
            $artList=Article::where($map)
                ->order('create_time','desc')
                ->paginate(4);
            $this->view->assign('cateName','全部文章');
        }
/*        //列表分页显示
        $artList=Article::all(function($query)use($cateId){
            if(isset($cateId)){
                $query->where('status',1)
                    ->where('cate_id',$cateId)
                    ->order('create_time','desc')
                    ->limit(3,4);
            }

            $query->where('status',1)
                    ->order('create_time','desc')
                    ->limit(2,4);

    });*/
        $this->view->assign('empty','<h3>没有文章</h3>');
        $this->view->assign('artList',$artList);
        return $this->fetch('index',['title'=>'社区问答']);
    }
//添加文章界面
public function insert()
{
    //1.登录才允许发布
    $this->isLogin();
    // 2.设置页面标题
    $this->view->assign('title', '发布文章');
    // 3.获取栏目信息
    $cateList = ArtCate::all();
    if (count($cateList) > 0) {
        //将查询到的栏目信息赋值给模板
        $this->assign('cateList', $cateList);
    } else {
        $this->error('请先添加栏目', 'index/index');
    }

    // 4.发布界面渲染
    return $this->view->fetch('insert');
}
//保存文章
 public function save(){
     //判断提交类型
        if(Request::isPost()){
            $data=Request::post();
            $res=$this->validate($data,'app\common\validate\Article');
            if(true!==$res){
                //验证失败
                $this->error($res, 'index/insert');
            }else{
                //获取一下上传图片信息
                //在本地
                if(!empty(Request::file())){
                $file=Request::file('title_img');

                //文件信息验证成功后,再上传到服务器上的指定目录 以public为起始目录
                $info=$file->validate([    //在服务器
                    'require'=>'require',
                    'size'=>209715200,
                    'ext'=>'jpeg,jpg,png,gif',
                ])->move('uploads/');
                if($info){
                   $data['title_img']= $info->getSaveName();
                }else{
                    $this->error($file->getError(),'index/index/insert');
                }
                //将数据写到数据库中
                if(Article::create($data)){
                    $this->success('文章发布成功','index/index');
                }else{
                    $this->error('文章保存失败');
                }
            }else{
                    $this->error("图片不能为空",'index/index/insert');
                }
            }
        }else{
            $this->error('请求类型错误');
        }
    }
//详情页
public function detail(){
        $artId=Request::param('id');
        halt($artId);
    $ArtPl=PingLun::where('art_id',$artId)
        ->order('reply_id','asc')
        ->order('create_time','desc')
        ->paginate(10);
    $this->view->assign('ArtPl',$ArtPl);
        $art=Article::get(function($query)use($artId){
        $query->where('id','=',$artId)->setInc('pv');
    });
    /*    $art1=Db('think_article')->where('id',$artId)->find();
        Db('think_article')->where('id',$artId)->update(['pv'=>$art1['pv']+1]);
        $art=Db('think_article')->where('id',$artId)->find();*/
  /*  $art=Article::where('id',$artId)->find();*/
/*    Db('think_article')->where('id',$artId)->setInc('pv');  更新
    $art=Db('think_article')->where('id',$artId)->find();  取回*/

        if(!is_null($art)){
            $this->view->assign('art',$art);
        }


        //添加评论信息

/*        if($ArtPl=PingLun::all(function($query)use($artId){
        $query->where('status',1)
            ->where('art_id',$artId)
            ->order('create_time','desc');
    })){
            $this->view->assign('ArtPl',$ArtPl);
        }*/

        $this->view->assign('title','详情页');
    $this->view->assign('empty','<span>没有任何数据</span>span>');
        return $this->view->fetch('detail');
}
    public function fav(){
    //获取从前端传递过来的数据

    if(!Request::isAjax()){
    return ['status'=>-1,'message'=>'请求类型错误'];
    }
    $data = Request::param();

/*    if(!(Db('think_user')->where('id',$data['session_id'])->find())['id']){*/
if(empty($data['session_id'])){
        return ['status'=>2,'message'=>'请登录收藏'];
    }
    //查询条件
    $map[]=['user_id','=',$data['user_id']];
    $map[]=['article_id','=',$data['article_id']];
    $fav=Db('think_user_fav')->where($map)->find();

if(is_null($fav)){
    //增添
    Db('think_user_fav')->data([
        'user_id'=>$data['user_id'],
        'article_id'=>$data['article_id']
    ])->insert();
    return ['status'=>1,'message'=>'收藏成功'];
}else{
    //删除
    Db('think_user_fav')->where($map)->delete();
    return ['status'=>0,'message'=>'点击收藏'];
}

}
    public function ok(){
        //获取从前端传递过来的数据

        if(!Request::isAjax()){
            return ['status'=>-1,'message'=>'请求类型错误'];
        }
        $data = Request::param();
        if(empty($data['session_id'])){
            return ['status'=>2,'message'=>'请登录点赞'];
        }
        //查询条件
        $map[]=['user_id','=',$data['user_id']];
        $map[]=['article_id','=',$data['article_id']];
        $fav=Db('think_user_ok')->where($map)->find();

        if(is_null($fav)){
            //增添
            Db('think_user_ok')->data([
                'user_id'=>$data['user_id'],
                'article_id'=>$data['article_id']
            ])->insert();
            return ['status'=>1,'message'=>'点赞成功'];
        }else{
            //删除
            Db('think_user_ok')->where($map)->delete();
            return ['status'=>0,'message'=>'点赞'];
        }

    }
    /*public function thinkPl(){
        $PingLun=Request::param();
        $PingLun['user_id']=Session::get('user_id');

        $artId=$PingLun['art_id'];
        $art=Article::get(function($query)use($artId){
            $query->where('id','=',$artId)->setInc('pv');
        });

        if(!is_null($art)){
            $this->view->assign('art',$art);
        }

        $ArtPllou=PingLun::where('art_id',$artId)
            ->order('lou','desc')
            ->find();//获取现最高楼
        if(empty($ArtPllou)){
            $PingLun['lou']=1;
        }else{
            $PingLun['lou']=$ArtPllou['lou']+1;
        }
        $rule=[
            'content|评论内容'=>'require|length:5,10000',
        ];
        $res=$this->validate($PingLun,$rule);
        if(true!==$res){//假如验证失败
            $this->error('评论不合规','index');
        }else{//假如验证通过
            if(PingLun::create($PingLun)){
                $ArtPl=PingLun::where('art_id',$artId)
                    ->order('create_time','desc')
                    ->paginate(3);//获取评论 逆时针遍历
                $this->view->assign('ArtPl',$ArtPl);//模板渲染
                $this->view->assign('title','详情页');
                $this->view->assign('empty','<span>没有任何数据</span>span>');
                return $this->view->fetch('detail');
            }
        }

    }*/

    public function insertComment(){
        if(Request::isAjax()){
            //1.获取到评论内容
            $data=Request::param();

            $artId=$data['art_id'];
            $ArtPllou=PingLun::where('art_id',$artId)
                ->order('lou','desc')
                ->find();//获取现最高楼
            if(empty($ArtPllou)){
                $data['lou']=1;
            }else{
                $data['lou']=$ArtPllou['lou']+1;
            }
            $data['reply_id']=1;
          /*  if(empty($data['reply_id'])){

                $data['reply_id']=0;
            }else{
                $data['reply_id']=$data['reply_id']+1;
            }*/
            if(!(Session::get('user_id'))){
                return ['status'=>0,'message'=>'评论发送不成功,请登录账号'];
            }
            $data['user_id']=Session::get('user_id');
            //2.将用户留言保存到表
            if(PingLun::create($data,true)){

                return ['status'=>1,'message'=>'评论发送成功'];
        }

            return ['status'=>0,'message'=>'评论发送不成功'];
        }
    }
    //留念
    public function PlHuifu(){

        if(Request::isAjax()){
            //1.获取到评论内容
            $data=Request::param();

            $artId=$data['art_id_1'];
            $data['art_id']=$data['art_id_1'];
            $data['user_id']=$data['user_id_1'];
            $data['content']=$data['pingl'];

            unset($data['art_id_1']);
            unset($data['pingl']);
            unset($data['user_id_1']);

            $ArtPllou=PingLun::where('art_id',$artId)
                ->order('lou','desc')
                ->find();//获取现最高楼
            if(empty($ArtPllou)){
                $data['lou']=1;
            }else{
                $data['lou']=$ArtPllou['lou']+1;
            }

            if(empty($data['reply_id'])){

                $data['reply_id']=0;
            }else{
                $data['reply_id']=$data['reply_id']+1;
            }

            if(!(Session::get('user_id'))){
                return ['status'=>0,'message'=>'评论发送不成功,请登录账号'];
            }
            $data['user_id']=Session::get('user_id');
            //2.将用户留言保存到表
            if(PingLun::create($data,true)){
                return ['status'=>1,'message'=>'评论发送成功'];
            }

            return ['status'=>0,'message'=>'评论发送不成功'];
        }
    }
}


