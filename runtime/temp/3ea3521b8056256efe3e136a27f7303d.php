<?php /*a:1:{s:73:"D:\myphp_www\PHPTutorial\WWW\think\application\index\view\index\text.html";i:1551190587;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($title); ?></title>
</head>
<body>
<h4>1111</h4>
<input type="button" value="秦秋" onclick="req()">
</body>
<script>
    function req(){
    var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function () {

            if(this.readyState==4){
                alert('请求结束');
                alert('内容是'+this.responseText);
            }
        }

    xhr.open('get','test1',true);
    xhr.send(null);

    }
</script>
</html>