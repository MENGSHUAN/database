<?php
//修改密碼

include_once('db.php');
include_once('html.php');
include_once('html_utility.php');

//用session傳遞student_id
session_start();
$student_id = $_SESSION["student_id"];

//select student data
$sql = "select student_id,name,grade,department,total_credits from student where student_id = \"$student_id\""; 
$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
$row = mysqli_fetch_array($result);


?>

<!DOCTYPE html>
<html>
<head>
<title>修改密碼</title>
</head>
<body>

  <a href = "homepage.php"> 回上頁(homepage) </a> <p>

  <br>
  <div>
    <h3> Student's infomation : </h3>
    <p> <?php print 'student_id: ' . $row['student_id']; ?> </p>
    <p> <?php print " name: " . $row['name']; ?> </p>
    <p> <?php print " grade: "  . $row['grade']; ?> </p>
    <p> <?php print " department: " . $row['department']; ?> </p>
    <p> <?php print " total_credits: " . $row['total_credits']; ?> </p>
  </div>
  <br>
  <br>
  <br>
  <hr>
  <br>
  <br>
  <br>
  <form name="form1" method="post" action="modify_password.php" >請輸入新密碼: <br> <input name="MyPassword">
        <br>
        <br>
        <input type="submit" value="提交">
  </form>



</body>
</html>



