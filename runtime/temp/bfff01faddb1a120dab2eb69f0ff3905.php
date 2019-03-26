<?php /*a:4:{s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\user\useredit.html";i:1550668299;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\layout.html";i:1550909985;s:73:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\nav.html";i:1550682140;s:74:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\left.html";i:1550915962;}*/ ?>
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
            
<h4 class="text-center text-danger">编辑用户信息</h4>
<form class="form-horizontal" action="<?php echo url('user/doEdit'); ?>" method="post">
    <div class="form-group">
        <label  class="col-sm-2 control-label">用户名:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="<?php echo htmlentities($userInfo['name']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-2 control-label">邮箱:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="<?php echo htmlentities($userInfo['email']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-2 control-label">手机号:</label>
        <div class="col-sm-10">
            <input type="mobile" class="form-control" name="mobile" value="<?php echo htmlentities($userInfo['mobile']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-2 control-label">密码:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($userInfo['password']); ?>">
        </div>
    </div>
    <!--隐藏域-->
            <input type="hidden" name="id" value="<?php echo htmlentities($userInfo['id']); ?>">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-info">保存</button>
        </div>
    </div>
</form>

        </div>
    </div>
</div>
</body>
</html>