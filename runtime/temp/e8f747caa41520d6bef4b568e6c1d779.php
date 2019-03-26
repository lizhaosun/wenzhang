<?php /*a:5:{s:75:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\index\insert.html";i:1550908148;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\header.html";i:1550475384;s:73:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\nav.html";i:1553574698;s:75:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\right.html";i:1551300638;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\footer.html";i:1550239036;}*/ ?>
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

<!-- 主体 -->
<div class="row ">
    <!-- 左侧8列 -->
    <div class="col-md-8 navbar-left">
        <!-- 页头 -->
        <div class="page-header">
            <h2>发布文章</h2>
        </div>
        <!-- 注册表单:采用水平表单 -->
        <form action="<?php echo url('index/index/save'); ?>"  method="post" id="login" name="login" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo htmlentities(app('session')->get('user_id')); ?>">
            <div class="form-group">
                <label for="title" class="control-label">标题</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="文章标题">
            </div>
            <div class="form-group">
                <label for="title" class="control-label">分类</label>
                <select name="cate_id" id="" class="form-control">
                    <?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($cate['id']); ?>"><?php echo htmlentities($cate['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title" class="control-label">内容</label>
                <textarea class="form-control" name="content" id="content" style="min-height:250px"></textarea>
            </div>
            <div class="form-group">
                <label for="title_img" class="control-label">图片</label>
                <input type="file" name="title_img" class="form-control" id="title_img" placeholder="标题图片">
            </div>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submit">保存</button>
            </div>
        </form>
        <script>
            bkLib.onDomLoaded(function() {
                new nicEditor({iconsPath : '/static/js/nicEditorIcons.gif'}).panelInstance('content');
            });
        </script>
    </div>
</div>

<!--<script>
    var submit = document.getElementById('submit');  //获取提交按钮
    submit.onclick = function () {
        //1.创建Ajax对象
        var xhr = new XMLHttpRequest();
        //2.创建请求事件的监听
        xhr.onreadystatechange = function () {
            if(xhr.readyState==4 && xhr.status == 200){
                alert('1');
                console.log(xhr.responseText);
                //解析返回的json字符串
                /*var json = JSON.parse(xhr.responseText);*/
               /* var tips = document.getElementById('tips');
                tips.innerHTML = '欢迎用户'+json.name+'再次回来';*/
            }
        }
        //3.初始化一个url请求
        var user = document.getElementById('name').value;
        var password = document.getElementById('password').value;
        var email = document.getElementById('email').value;
        var mobile = document.getElementById('mobile').value;
        var data = 'name='+user+'&password='+password+'&email='+email+'&mobile='+mobile;//生成post请求数据
        alert(data);
        var url = 'insert';
        xhr.open('post',url,true); //请求类型为post，交互方式为异步
        //4.设置请求头
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //5.发送url请求
        xhr.send(data);
        return false;  //禁止提交按钮的默认行为
    }
</script>-->

<script>
    $(document).ready(function(){
        $("#submit").click(function(){
            $.ajax({
                type:"POST",
                url:"insert",
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
    });

</script>



</div>
</div>
</body>
</html>