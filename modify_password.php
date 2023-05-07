<?php
//修改student_Password

include_once('db.php'); 
include_once('html.php');
include_once('html_utility.php');

//用session傳遞student_id
session_start();

//取得student_id
$Myid = $_SESSION["student_id"];

//取得student_sassword
$MyPassword = $_POST["MyPassword"];

// update student_password (in student table)
$sql = "update student set student_password = $MyPassword where student_id = \"$Myid\"";
$result = mysqli_query($conn, $sql) or die('MySQL query error : update student_password error ');	



?>


<html>
<head>
  <title></title>
</head>
<body>
<a href = "password.php"> 回上頁 </a> <p>
<script>
    window.alert("您的密碼已成功修改");
    window.location.href = "password.php"; 
</script>
</body>
</html>



<?php
$conn->close();
?>