<?php
session_start();
require("dbconnect.php");
if (isset($_GET['m'])){
	$msg="<font color='red'>" . $_GET['m'] . "</font>";
} else {
	$msg="Good morning";
}
$sql = "select * from todo where status = 0 ORDER BY importance ASC;";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>my Todo List !! </p>
<hr />
<div><?php echo $msg; ?></div><hr>
<button><a href="todoRpt.php">工作報表</a></button><br>
<button><a href="bosslist.php">老闆專用</a></button><br>
<table width="500" border="1">
  <tr>
    <td>id</td>
    <td>title</td>
    <td>message</td>
    <td>交辦人</td>
    <td>重要性</td>
    <td>status</td>
  </tr>
<?php
while (	$rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" . $rs['id'] . "</td>";
	echo "<td>{$rs['title']}</td>";
	echo "<td>" , htmlspecialchars($rs['content']), "</td>";
    echo "<td>".$rs['assignee'] . "</td>";
        if($rs['importance'] == 1){
        echo "<td><font color='#FF0000'>緊急</font></td>";
    }else if($rs['importance'] == 2){
        echo "<td><font color='##ffd700'>重要</font></td>";
    }else{
        echo "<td>一般</td>";
    }
	echo "<td><a href='todoSet.php?id={$rs['id']}'>OK</a>" . "</td>";
    //echo "<td><a href='todoEditForm.php?id={$rs['id']}'>Edit</a></td>";
    echo "</tr>";
}

$sql = "select * from todo where status = 1;";
$result=mysqli_query($conn,$sql);
$rs=mysqli_num_rows($result);
$sql2 = "select * from todo where status = 0;";
$result2=mysqli_query($conn,$sql2);
$rs2=mysqli_num_rows($result2);
echo "已完成".$rs."件工作</br>";
echo "未完成".$rs2."件工作";
?>
</table>
</body>
</html>
