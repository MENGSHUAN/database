<a href = "homepage.php"> 回上頁(Homepage) </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');
session_start();
$student_id = $_SESSION["student_id"];

//select student data
$sql = "select student_id,name,grade,department,total_credits from student where student_id = \"$student_id\""; 
$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
$row = mysqli_fetch_array($result);
?>
<html>

<head>
	<title>學生資訊</title>
	<link id="fcu_selected" rel="shortcut icon" href="Logo.png" type="image/png">
</head>

<body>
    <div id="show">
        <form>
            <legend>
                <p> Student's infomation : </p>
                <p> <?php print 'student_id: ' . $row['student_id']; ?> </p>
                <p> <?php print " name: " . $row['name']; ?> </p>
                <p> <?php print " grade: "  . $row['grade']; ?> </p>
                <p> <?php print " department: " . $row['department']; ?> </p>
                <p> <?php print " total_credits: " . $row['total_credits']; ?> </p>
            </legend>    
        </form>
    </div>
</body>
</html>

