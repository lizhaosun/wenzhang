<?php /*a:4:{s:82:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\article\articleEdit.html";i:1550911832;s:76:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\layout.html";i:1550909985;s:73:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\nav.html";i:1550682140;s:74:"D:\myphp_www\PHPTutorial\WWW\think\application\admin\view\public\left.html";i:1550749317;}*/ ?>
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
    <li ><a href=""><span class="glyphicon glyphicon-cog"></span>网站管理</a></li>
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
            
<div>
<h4 class="text-center text-success">编辑文章</h4>
<form action="<?php echo url('article/doEdit'); ?>"  method="post" id="login" name="login" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo htmlentities(app('session')->get('user_id')); ?>">
    <input type="hidden" name="id" value="<?php echo htmlentities($articleInfo['id']); ?>">
    <div class="form-group">
        <label for="title" class="control-label">标题</label>
        <input type="text" name="title" class="form-control" id="title" value="<?php echo htmlentities($articleInfo['title']); ?>">
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
        <textarea class="form-control" name="content" id="content" style="min-height:250px" ><?php echo htmlentities($articleInfo['content']); ?></textarea>
    </div>
    <img src="/uploads/<?php echo htmlentities($articleInfo['title_img']); ?>"  class="img-thumbnail" width="150px">
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
    </div>
</div>
</body>
</html>