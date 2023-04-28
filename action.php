<a href = "index.php"> Go Query Interface</a> <p>
<?php
include_once('html.php');
include_once('html_utility.php');
include('inc/header.php');
include('include_files.php');
include('inc/container.php');
	if(isset($_POST['MyHead'])) {
		$MyHead=$_POST["MyHead"];
	
		$dbhost = '127.0.0.1';
		$dbuser = 'hj';
		$dbpass = 'test1234';
		$dbname = 'testdb';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
		mysqli_query($conn, "SET NAMES 'utf8'");
		mysqli_select_db($conn, $dbname);
		$sql = "SELECT * FROM student where student_id LIKE \"".$MyHead."%\";";
		$result = mysqli_query($conn, $sql) or die('MySQL query error');
	
		html_start_box('****  Student  ****  ', '50%', '   ', '5', 'center', '   ');

		while($row = mysqli_fetch_array($result)){
	//		print $row['student_id']. "---" . $row['name'] .  "---"  . $row['department']. "<p>";
			form_selectable_cell($row['student_id'] , $row['student_id']);
			form_selectable_cell($row['name'], $row['name']);
			form_selectable_cell($row['grade'], $row['grade']);			
			form_selectable_cell($row['department'], $row['department']);
			form_selectable_cell($row['total_credits'], $row['total_credits']);			

			form_selectable_cell(filter_value("Add", "", '.add.php?action=add&id=' . $row['student_id'] ), "Add");			
			form_selectable_cell(filter_value("Delete", "", '.delete.php?action=delete&id=' . $row['student_id'] ), "Delete");			

			form_end_row();
			
		}

		html_end_box(false);

	}
?>
