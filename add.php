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
}else{
    echo "连接成功",'<br/>';
}

mysqli_select_db($conn,'php10');//选择数据库
mysqli_set_charset($conn, 'utf8');//设定数据库连接字符集

if (isset($_POST['submit'])) {
    $nameright = $_POST['nameright'];
    $textfont = $_POST['textfont'];
    $idvalue = $_POST['idvalue'];
    $create_time = date("Y-m-d H:i:s");
}else{
    echo '数据添加失败';
}
//添加愿望
$sql = "INSERT INTO `wish`(`username`,`content`,`color`,`create_time`) VALUES('$nameright','$textfont','$idvalue','$create_time')";

$result = mysqli_query($conn,$sql);//执行语句
if (!$result){
    die('许愿失败：'.mysqli_error($conn));
}else{
    echo '许愿成功',header("refresh:2; url=index.php");
}

mysqli_close($conn);//关闭连接