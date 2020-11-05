<?php
require("dbconnect.php");
$title=mysqli_real_escape_string($conn,$_POST['title']);
$msg=mysqli_real_escape_string($conn,$_POST['msg']);
$assignee=mysqli_real_escape_string($conn,$_POST['assignee']);
$importance=mysqli_real_escape_string($conn,$_POST['importance']);
if ($title) { //if title is not empty
	$sql = "insert into todo (title, content, assignee, status,importance) values ('$title', '$msg', '$assignee', 0,$importance);";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL
	$msg="Message added";
} else {
	$msg="Message title cannot be empty";
}
header("Location: bosslist.php?m=$msg");
?>