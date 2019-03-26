<?php /*a:6:{s:75:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\index\detail.html";i:1553574242;s:74:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\base.html";i:1550238126;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\header.html";i:1550475384;s:73:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\nav.html";i:1553574698;s:75:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\right.html";i:1551300638;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\footer.html";i:1550239036;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:"页面标题")); ?></title>
<!--        <link rel="stylesheet" href="/static/css/bootstrap.css">
        <script src="/static/js/jquery-3.3.1.min.js"></script>
        <script src="/static/js/bootstrap.js"></script>-->
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
    <script type="text/javascript" src="/static/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/static/nicedit/nicEdit.js"></script>
</head>
<body>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <!--导航-->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo url('index/index'); ?>"><?php echo htmlentities((isset($siteName) && ($siteName !== '')?$siteName:"社区问答")); ?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li
                        <?php if(empty(app('request')->param('cate_id')) || ((app('request')->param('cate_id') instanceof \think\Collection || app('request')->param('cate_id') instanceof \think\Paginator ) && app('request')->param('cate_id')->isEmpty())): ?>
                        class="active"

                        <?php endif; ?>
                        ><a href="<?php echo url('index/index'); ?>">首页 </a></li>
                        <?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                        <li
                                
                                <?php if($cate['id'] == app('request')->param('cate_id')): ?>
                        class="active"
                        <?php endif; ?>
                                ><a href="<?php echo url('index/index',['cate_id'=>$cate['id']]); ?>"><?php echo htmlentities($cate['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>

                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <form class="navbar-form navbar-left" action="<?php echo url('index/index'); ?>" method="get">
                            <div class="form-group">
                                <input type="text" name="keywords" class="form-control" placeholder="请输入关键字">
                            </div>

                            <button type="submit" class="btn btn-default">搜索</button>
                        </form>
                        <?php if(app('session')->get('user_id')): ?>
                        <li><a href="#"><?php echo htmlentities(app('session')->get('user_name')); ?></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">操作 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo url('index/insert'); ?>">发布文章</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/admin.php/user/login">回到后台</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo url('user/logout'); ?>">退出登录</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li><a href="<?php echo url('user/login'); ?>">登录</a></li>
                        <li><a href="<?php echo url('user/register'); ?>">注册</a></li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>

</div>
<div class="col-md-4 navbar-right">
    <div class="page-header">
        <h2 >热门排行</h2>
    </div>
    <div>
        <div class="list-group">

            <?php if(is_array($hotArtList) || $hotArtList instanceof \think\Collection || $hotArtList instanceof \think\Paginator): $i = 0; $__LIST__ = $hotArtList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$artpv): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo url('detail',['id'=>$artpv['id']]); ?>" class="list-group-item
            <?php if($i == '1'): ?>
            active
            <?php endif; ?>

"><?php echo mb_substr($artpv['title'],0,15).'...'; ?><span class="badge"><?php echo htmlentities($artpv['pv']); ?></span></a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="page-header">
            <h2><?php echo htmlentities(getCateName($art['cate_id'])); ?></h2>
        </div>
        <div>
            <img class="img-rounded" src="/uploads/<?php echo htmlentities($art['title_img']); ?>"
                 style="margin-right: 30px;object-fit: contain;float: left;width: 600px;"/>
            <div class="content-detail" style="float: left;width: 70%">
                <!-- 获取当前文章的id -->
                <h4><?php echo htmlentities($art['title']); ?></h4>
                <p>作者:<?php echo htmlentities(getUserName($art['user_id'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    发布时间：<?php echo htmlentities($art['create_time']); ?>&nbsp;&nbsp;&nbsp;&nbsp;阅读量:<?php echo htmlentities($art['pv']); ?>
                </p>
                <div><?php echo htmlentities(getArtContent($art['content'])); ?></div>
                <button   class="btn btn-default" type="button" id="fav" user_id="<?php echo htmlentities($art['user_id']); ?>"
                          article_id="<?php echo htmlentities($art['id']); ?>" session_id="<?php echo htmlentities(app('session')->get('user_id')); ?>">点击收藏</button>
                <button style="margin-left: 30px;" class="btn btn-warning" type="button" id="ok" user_id="<?php echo htmlentities($art['user_id']); ?>"
                        article_id="<?php echo htmlentities($art['id']); ?>" session_id="<?php echo htmlentities(app('session')->get('user_id')); ?>">点赞</button>
                <hr/>
            </div>
        </div>

        <?php if(is_array($ArtPl) || $ArtPl instanceof \think\Collection || $ArtPl instanceof \think\Paginator): $i = 0; $__LIST__ = $ArtPl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$artpl): $mod = ($i % 2 );++$i;?>
        <form class="form-horizontal"  action="" name="fM<?php echo htmlentities($artpl['id']); ?>" id="fM<?php echo htmlentities($artpl['id']); ?>" method="post">
            <div class="content-detail" style="width:600px;float: left;margin-left: <?php echo htmlentities($artpl['reply_id']*10); ?>px;">
                <h5><?php echo htmlentities($artpl['lou']); ?>#</h5>
                <p>作者:<?php echo htmlentities(getUserName($artpl['user_id'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    发布时间：<?php echo htmlentities($artpl['create_time']); ?>
                </p>
                <div ><?php echo htmlentities($artpl['content']); ?></div>
                <div class="col-sm-12" id="chuandi" data-chuan="0" data-id="0" data-state="1">
                    <button type="button" class="col-md-2 "  onclick="butPl(<?php echo htmlentities($artpl['id']); ?>)" style="float:right;
                    <?php if($artpl['reply_id'] == '1'): ?>
                    display:none
                    <?php endif; ?>
                    " id="PlHuifu<?php echo htmlentities($artpl['id']); ?>" >回复</button>
                    <!--隐藏发布拦-->
                    <div name="content<?php echo htmlentities($artpl['id']); ?>" id="content<?php echo htmlentities($artpl['id']); ?>"   style="display:none">

                        <textarea class="form-control" rows="4" name="pingl" id="pingl"></textarea>
                        <input type="hidden" name="reply_id" id="reply_id" value="<?php echo htmlentities($artpl['reply_id']); ?>">
                        <input type="hidden" id="art_id_1" name="art_id_1" value="<?php echo htmlentities($art['id']); ?>">
                        <input type="hidden" id="user_id_1" name="user_id_1" value="<?php echo htmlentities(app('session')->get('user_id')); ?>">
                        <button type="button" onclick="Planniu(<?php echo htmlentities($artpl['id']); ?>)" class="btn btn-info col-sm-3" name="anniu" id="anniu" >发布</button>
                    </div>
                </div>
                <hr/>
            </div>
        </form>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="col-md-8">
        <?php echo $ArtPl; ?>
    </div>
    <form class="form-horizontal" action=""  method="get" id="loginpl" name="loginpl">
        <input type="hidden" id="art_id" name="art_id" value="<?php echo htmlentities($art['id']); ?>">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlentities(app('session')->get('user_id')); ?>">

        <div class="form-group">
            <label for="content" class="col-lg-10">评论</label>
            <div class="col-sm-6">
                <textarea class="form-control" name="content" id="content"  rows="4"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="submit" class="col-sm-10 control-label "></label>
            <div class="col-sm-10 ">
                <button type="button" class="btn btn-info col-sm-3" id="submit">发布</button>
            </div>
        </div>
    </form>
    <p class="text-success" id="res"></p>
    <script type="text/javascript">
        $('#submit').on('click',function(){
            $.getJSON("<?php echo url('index/insertComment'); ?>",$('#loginpl').serialize(),function(data){
                if(data.status==1){

                    alert(data.message);
                    window.location.reload();
                }else{
                    alert(data.message)
                    window.location.reload();
                }
            })

        })
//留念
        function Planniu(id){
            var fmId=document.getElementById('fM'+id);

            $.ajax({
                type:"POST",
                url:"<?php echo url('index/PlHuifu'); ?>",
                data:$(fmId).serialize(),
                dataType:"json",
                success:function(data){
                    if(data.status==1){
                        window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            })
        }
        function butPl(id){
            /* var contentId=document.getElementById('content'+id);
             var contentName=document.getElementsByName('content');
             $(contentId).show('slow',function(even){
             });*/

            var contentId=document.getElementById('content'+id);
            var state1=$('#chuandi').data('state');     /*//获取data-state的值计算按钮次数*/
            var state2=$('#chuandi').data('id');            /*//获取data-id的值*/
            if((state1==1)&&(state2!==id)){      /* //判断打开评论栏*/
                $(contentId).show(1,function(even){

                    $('#chuandi').data('state',2);
                    $('#chuandi').data('id',id);
                })}else{
                if (state1==2) {        /*//判断关闭评论栏*/
                    var PlId=document.getElementById('content'+state2);
                    $(PlId).hide(1,function(even){

                        $('#chuandi').data('state',1);
                        $(contentId).data('id',0);
                        if(state2!==id){        /*//相同id的话,评论栏操作*/

                            $(contentId).show(1,function(even){
                                $('#chuandi').data('state',2);
                                $('#chuandi').data('id',id);
                            })}else{
                            $(contentId).hide(1,function(even){

                                $('#chuandi').data('state',1);
                                $('#chuandi').data('id',0);
                            })
                        }
                    })

                }

            }
        }

        /*  $(document).ready(function(){
              $("#fav").click(function(){
                  var userId = $(this).attr('user_id')
                  var artId = $(this).attr('article_id')
                  if( userId && artId ){
                  $.ajax({
                      type:"get",
                      url : "<?php echo url('index/fav'); ?>",
                      data: {
                          user_id    : userId,
                          article_id : artId,

                          time:new Date().getTime()
                      },
                      dataType : 'json',
                      success: function(data){ //php数据传回来然后执行(所以必须要符合dataType的格式)
                          switch(data.status){
                              case 1:
                                  alert(data.message);
                                  window.location.href = "<?php echo url('index/index'); ?>";
                                  break;
                              case 0:
                              case-1:
                                  alert(data.message);
                                  window.location.back();
                                  break;
                          }
                      },
                      error:function(jqXHR){
                          alert("错误:"+jqXHR.message);
                      }
                  });}
              });
          });
*/
        /* $(document).ready(function(){
             $("#fav").click(function(){
                 $.ajax({
                     type:"get",
                     url:"<?php echo url('index/fav'); ?>",
                     data: $("#login").serialize(),//数据传到PHP文件
                     dataType:"json",
                     success: function(data){ //php数据传回来然后执行(所以必须要符合dataType的格式)
                         switch(data.status){
                             case 1:
                                 alert(data.message);
                                 window.location.href = "<?php echo url('index/index'); ?>";
                                 break;
                             case 0:
                             case-1:
                                 alert(data.message);
                                 window.location.back();
                                 break;
                         }
                     },
                     error:function(jqXHR){
                         alert("错误:"+jqXHR.message);
                     }
                 });
             });
         });*/

        $(function(){
            $('#fav').on('click',function(){
                //获取当前的用户id与栏目id,因为收藏表中有这二个字段
                var userId = $(this).attr('user_id')
                var artId = $(this).attr('article_id')
                var sessionId = $(this).attr('session_id')
                if (userId && artId){
                    $.ajax(
                        {
                            type: 'get',
                            url: "<?php echo url('index/index/fav'); ?>",
                            data: {
                                user_id: userId,
                                article_id: artId,
                                session_id:sessionId,
                                time: new Date().getTime()
                            },
                            dataType: 'json',
                            success  : function(data){
                                switch(data.status){
                                    case 1:
                                        $('#fav').attr('class','btn btn-success');
                                        $('#fav').text(data.message);
                                        break;
                                    case 0:
                                        $('#fav').attr('class','btn btn-default');
                                        $('#fav').text(data.message);
                                        break;
                                    case -1:
                                        alert(data.message);
                                        break;
                                    case 2:
                                        alert(data.message);
                                        window.location.href = "<?php echo url('user/login'); ?>";
                                        break;
                                }
                            },
                            error:function(jqXHR){
                                alert("错误:"+jqXHR.message);
                            }
                        }
                    )}})})
        $(function(){
            $('#ok').on('click',function(){
                //获取当前的用户id与栏目id,因为收藏表中有这二个字段
                var userId = $(this).attr('user_id')
                var artId = $(this).attr('article_id')
                var sessionId = $(this).attr('session_id')
                if (userId && artId){
                    $.ajax(
                        {
                            type: 'get',
                            url: "<?php echo url('index/index/ok'); ?>",
                            data: {
                                user_id: userId,
                                article_id: artId,
                                session_id:sessionId,
                                time: new Date().getTime()
                            },
                            dataType: 'json',
                            success  : function(data){
                                switch(data.status){
                                    case 1:
                                        $('#ok').attr('class','btn btn-success');
                                        $('#ok').text(data.message);
                                        break;
                                    case 0:
                                        $('#ok').attr('class','btn btn-warning');
                                        $('#ok').text(data.message);
                                        break;
                                    case -1:
                                        alert(data.message);
                                        break;
                                    case 2:
                                        alert(data.message);
                                        window.location.href = "<?php echo url('user/login'); ?>";
                                        break;

                                }
                            },
                            error:function(jqXHR){
                                alert("错误:"+jqXHR.message);
                            }
                        }
                    )}})})
    </script>

    



</div>
</div>
</body>
</html>