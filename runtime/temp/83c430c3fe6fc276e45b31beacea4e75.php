<?php /*a:4:{s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\user\catelist.html";i:1550680714;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\layout.html";i:1550657246;s:73:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\nav.html";i:1550682140;s:74:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\left.html";i:1550665241;}*/ ?>
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
    <li ><a href=""><span class="glyphicon glyphicon-cog"></span>网站管理</a></li>
</ul>
<?php endif; ?>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header h3">用户管理</li>
    <li ><a href="<?php echo url('user/userList'); ?>"><span class="glyphicon glyphicon-user"></span>用户列表</a></li>
</ul>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header h3">文章管理</li>
    <li ><a href=""><span class="glyphicon glyphicon-th-list"></span>分类管理</a></li>
    <li ><a href=""><span class="glyphicon glyphicon-list-alt"></span>文章管理</a></li>
</ul>
        </div>
        <div class="col-md-10">
            
<h4 class="text-center text-success">用户列表</h4>
<table class="table table-default table-hover text-center">
    <tr>
        <td>ID</td>
        <td>用户名</td>
        <td>邮箱</td>
        <td>手机号</td>
        <td>注册时间</td>
        <td>身份</td>
        <td>状态</td>
        <td colspan="2">操作</td>
    </tr>
    <?php if(is_array($userList) || $userList instanceof \think\Collection || $userList instanceof \think\Paginator): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><!--//遍历-->
    <tr>
        <td><?php echo htmlentities($user['id']); ?></td>
        <td><?php echo htmlentities($user['name']); ?></td>
        <td><?php echo htmlentities($user['email']); ?></td>
        <td><?php echo htmlentities($user['mobile']); ?></td>
        <td><?php echo htmlentities($user['create_time']); ?></td>
        <?php switch($user['is_admin']): case "2": break; case "1": if($user['admin_level']==1): ?><td>超级管理员</td><?php else: ?><td>管理员</td><?php endif; break; case "0": ?><td>注册会员</td><?php break; default: ?>
        <?php endswitch; switch($user['status']): case "1": ?><td>正常</td><?php break; case "0": ?><td>离线</td><?php break; default: ?>
        <?php endswitch; ?>
        <!--非当前用户不允许编辑其他用户资料-->
        <?php if($user['id'] == app('session')->get('admin_id')): ?>
        <td><a href="<?php echo url('user/userEdit',['id'=>$user['id']]); ?>">编辑</a></td>
        <?php endif; if($user['id'] != app('session')->get('admin_id')): ?>
        <td><a href="<!--javascript:;-->" onclick="dele();return false">删除</a></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; endif; else: echo "$empty" ;endif; ?>
</table>
<script>

    function dele(){
        if(confirm('你是真的要删除吗')==true){
            window.location.href="<?php echo url('user/doDelete',['id'=>$user['id']]); ?>"
        }
    }
</script>
        </div>
    </div>
</div>
</body>
</html>