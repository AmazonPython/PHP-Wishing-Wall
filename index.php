<?php
//字符集编码和时区设置
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
error_reporting(E_ALL^E_NOTICE);//抑制notice提示

//数据库连接
$conn = mysqli_connect('127.0.0.1','root','root');

//检测链接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($conn,'php10');//选择数据库
mysqli_set_charset($conn, 'utf8');//设定数据库连接字符集

$sql = "SELECT id,username,content,color,create_time FROM wish";//添加愿望

$result = mysqli_query($conn,$sql);//执行语句

if ($result){
    while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
        $rows[] = $row;
    }
}else{
    die('无法读取数据'.mysqli_error($conn));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>许愿墙</title>
    <link rel="stylesheet" href="./Css/index.css" />
    <script type="text/javascript" src='./Js/jquery-1.7.2.min.js'></script>
    <script type="text/javascript" src='./Js/index.js'></script>
    <style type="text/css">

    </style>
</head>
<body>
<div id='top'>
    <!--点击我要许愿跳转到wish.php页面-->
    <span id='send'></span>
</div>
<div id='main'><?php foreach ($rows as $val){?>
    <dl class='paper <?php echo $val['color'];?>'>
        <dt>
            <span class='username'><?php echo $val['username'];?></span>
            <span class='num'>NO:<?php echo $val['id'];?></span>
        </dt>
        <dd class='content'><?php echo $val['content'];?></dd>
        <dd class="bottom">
            <span class='time'><?php echo $val['create_time'];?></span>
            <!--点击此处删除愿望-->
            <a href="delete.php?id=<?php echo $val['id'];?>" class='close'></a>
        </dd>
    </dl>
</div><?php }?>

<!--[if IE 6]>
<script type="text/javascript" src="./Js/iepng.js"></script>
<script type="text/javascript">
    DD_belatedPNG.fix('#send,#close,.close','background');
</script>
<![endif]-->
</body>
</html>