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

$id = $_GET['id'];

$sql = "DELETE FROM wish WHERE id='$id'";//删除愿望

$result = mysqli_query($conn,$sql);//执行语句

if (!$result) {
    die("delete failed: " . mysqli_error($conn));
}else{
    echo '删除愿望成功',header("refresh:2; url=index.php");
}

mysqli_close($conn);//关闭连接