<?php
session_start();
require("dbconnect.php");

$sql = "select * from todo where status = 1 ORDER BY importance ASC;";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>my Finished Jobs !! </p>
<hr />
<hr>
<a href="todoList.php">Home</a><br>
<table width="500" border="1">
  <tr>
    <td>title</td>
    <td>message</td>
    <td>交辦人</td>
    <td>重要性</td>
  </tr>
<?php
while (	$rs=mysqli_fetch_assoc($result)) {
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
	echo "</tr>";
}

$sql = "select * from todo where status = 1;";
$result=mysqli_query($conn,$sql);
$rs=mysqli_num_rows($result);
echo "已完成".$rs."件工作";
?>
</table>
</body>
</html>
