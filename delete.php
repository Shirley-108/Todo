<?php
session_start();
require("dbconnect.php");
$myid=$_GET['id'];
$sql = mysqli_query($conn, "DELETE FROM `todo` where id = '$myid'");
$result = mysqli_query($conn,$sql);
$conn -> close(); // 關閉資料庫連線
header('Location: bosslist.php');//導回首頁
?>