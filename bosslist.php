<?php
session_start();
require("dbconnect.php");
if (isset($_GET['m'])){
	$msg="<font color='red'>" . $_GET['m'] . "</font>";
} else {
	$msg="Good morning";
}
$sql = "select * from todo ORDER BY status DESC,importance ASC;";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>老闆專用首頁!! </p>
<hr />
<div><?php echo $msg; ?></div><hr>
<a href="todoList.php">員工專用</a><br>
<table width="650" border="1">
  <tr>
    <td>title</td>
    <td>message</td>
    <td>交辦人</td>
    <td>重要性</td>
    <td>status</td>
    <td>完成</td>
    <td>編輯</td>
    <td>取消</td>
    <td>退件</td>
  </tr>
<?php
while ($rs=mysqli_fetch_assoc($result)) {
	echo "<tr>";
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
    echo "<td>".$rs['status'] . "</td>";
	echo "<td><a href='bossSet.php?id={$rs['id']}'>OK</a>" . "</td>";
    echo "<td><a href='bossEditForm.php?id={$rs['id']}'>Edit</a></td>";
    echo "<td><a href='delete.php?id={$rs['id']}'>取消</a></td>";
    echo "<td><a href='todoReject.php?id={$rs['id']}'>退件</a>" . "</td></tr>";
}
?>
</table>
<a href="addMessageForm.php">Add Task</a> 
</body>
</html>
