<?php /*a:4:{s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\cate\catelist.html";i:1550737778;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\layout.html";i:1550909985;s:73:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\nav.html";i:1550682140;s:74:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\left.html";i:1550915962;}*/ ?>
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
            <div class="row">
    <div class="col-md-12">
        <!--导航-->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo url('index/index'); ?>"><?php echo htmlentities((isset($siteName) && ($siteName !== '')?$siteName:"后台管理")); ?></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(app('session')->get('admin_id')): ?>
                        <li><a href="#"><?php echo htmlentities(app('session')->get('admin_name')); ?></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/index.php">回到前台</a></li>
                        <li><a href="<?php echo url('user/logout'); ?>">退出登录</a></li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>

</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?php if(app('session')->get('admin_level') == '1'): ?>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header h3">系统管理</li>
    <li ><a href="<?php echo url('site/index'); ?>"><span class="glyphicon glyphicon-cog"></span>网站管理</a></li>
</ul>
<?php endif; ?>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header h3">用户管理</li>
    <li ><a href="<?php echo url('user/userList'); ?>"><span class="glyphicon glyphicon-user"></span>用户列表</a></li>
</ul>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header h3">文章管理</li>
    <?php if(app('session')->get('admin_isAdmin') == '1'): ?>
    <li ><a href="<?php echo url('cate/cateList'); ?>"><span class="glyphicon glyphicon-th-list"></span>分类管理</a></li>
    <?php endif; ?>
    <li ><a href="<?php echo url('article/articleList'); ?>"><span class="glyphicon glyphicon-list-alt"></span>文章管理</a></li>
</ul>
        </div>
        <div class="col-md-10">
            
<h4 class="text-center text-success">分类管理</h4>
<table class="table table-default table-hover text-center">
    <tr>
        <td>ID</td>
        <td>栏目名称</td>
        <td>排序</td>
        <td>状态</td>
        <td>创建时间</td>
        <td colspan="2">操作</td>
    </tr>
    <?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><!--//遍历-->
    <tr>
        <td><?php echo htmlentities($cate['id']); ?></td>
        <td><?php echo htmlentities($cate['name']); ?></td>
        <td><?php echo htmlentities($cate['sort']); ?></td>
        <?php if($cate['status'] == '1'): ?>
        <td style="color:forestgreen">显示</td>
        <?php else: ?>
        <td style="color:gray">隐藏</td>
        <?php endif; ?>
        <td><?php echo htmlentities($cate['create_time']); ?></td>
        <td><a href="<?php echo url('cate/cateEdit',['id'=>$cate['id']]); ?>">编辑</a></td>
        <td><a href="<!--javascript:;-->" onclick="dele();return false">删除</a></td>
    </tr>
    <?php endforeach; endif; else: echo "$empty" ;endif; ?>
</table>
<a class="btn btn-info" href="<?php echo url('cate/cateAdd'); ?>" role="button">添加分类</a>
<script>

    function dele(){
        if(confirm('你是真的要删除吗')==true){
            window.location.href="<?php echo url('cate/doDelete',['id'=>$cate['id']]); ?>"
        }
    }
</script>
        </div>
    </div>
</div>
</body>
</html>