<?php
session_start();
require("dbconnect.php");
$id = (int)$_GET['id'];
$sql = "select * from todo where id = $id;";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
$rs=mysqli_fetch_assoc($result);
if (! $rs) {
	echo "no data found";
	exit(0);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>
<body>
<h1>Edit Task</h1>
<form method="post" action="todoUpdate.php">

        <input type='hidden' name='id' value='<?php echo $id ?>'>

        task title: <input name="title" type="text" id="title" value="<?php echo htmlspecialchars($rs['title']);?>" /> <br>

        task description: <input name="msg" type="text" id="msg" value="<?php echo htmlspecialchars($rs['content']);?>" /> <br>
        
        交辦人: <input name="msg" type="text" id="msg" value="<?php echo htmlspecialchars($rs['assignee']);?>" /> <br>
        
      <input type="submit" name="Submit" value="送出" />
      <input type="button" value="放棄" onclick="location.href='todoList.php'">
	</form>
  </tr>
</table>
</body>
</html>
