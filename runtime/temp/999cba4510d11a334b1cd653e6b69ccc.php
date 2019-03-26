<?php /*a:6:{s:74:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\index\index.html";i:1553576828;s:74:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\base.html";i:1553576828;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\header.html";i:1553576828;s:73:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\nav.html";i:1553576828;s:75:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\right.html";i:1553576828;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\public\footer.html";i:1553576828;}*/ ?>
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
            <h2><?php echo htmlentities($cateName); ?></h2>

        </div>
<?php if(is_array($artList) || $artList instanceof \think\Collection || $artList instanceof \think\Paginator): $i = 0; $__LIST__ = $artList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?>
       <div>
           <a href="<?php echo url('detail',['id'=>$art['id']]); ?>"><img class="img-rounded" src="/uploads/<?php echo htmlentities($art['title_img']); ?>"
                style="margin-right: 30px;object-fit: contain;float: left;width: 170px;height: 125px"/></a>
           <div class="content-detail" style="float: left;width: 70%">
               <!-- 获取当前文章的id -->
               <h4><a href="<?php echo url('detail',['id'=>$art['id']]); ?>"><?php echo htmlentities($art['title']); ?></a></h4>
               <p>作者:<?php echo htmlentities(getUserName($art['user_id'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                   发布时间：<?php echo htmlentities($art['create_time']); ?>&nbsp;&nbsp;&nbsp;&nbsp;阅读量:<?php echo htmlentities($art['pv']); ?>
               </p>
               <div><a href="<?php echo url('detail',['id'=>$art['id']]); ?>"><?php echo htmlentities(getArtContent($art['content'])); ?></a></div>
               <hr/>
           </div>
       </div>

      <?php endforeach; endif; else: echo "$empty" ;endif; ?>
        <div class="text-center">   <!--style="
	position: fixed;left: -210px;
	bottom: 180px;
	width: 100%;
	z-index: 100; ">-->
        <?php echo $artList; ?>
        </div>
       



</div>
</div>
</body>
</html>