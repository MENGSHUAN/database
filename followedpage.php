<a href = "homepage.php"> 回上頁(Homepage) </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');
@header("Content-type:text/html;charset=utf-8");

session_start();

if(isset($_SESSION["student_id"])) {
	$student_id =$_SESSION["student_id"];	


	//Student Selected Courses
	$sql = "select course_id, course_name, department, grade, credits, category
			from course 
			where course_id in (select course_id from followed_course
				where student_id = \"$student_id\")";

	//印出我的關注課程列表			
	$result = mysqli_query($conn, $sql) or die('MySQL query error');
	html_start_box('*****  我的關注課程列表 ******  ', '70%', '   ', '5', 'left', '   ');

	$display_text = array(
		array('display' => 'course_id',             'align' => 'left'),
		array('display' => 'Course Name',         'align' => 'left'),
		array('display' => 'Department',     'align' => 'left'),
		array('display' => 'Grade',     'align' => 'right'),
		array('display' => 'Credits', 'align' => 'right'),
		array('display' => 'Category', 'align' => 'right'),	
		array('display' => 'Action', 'align' => 'right'),	
	);
	/*html_header($display_text, 2, false);*/

	echo '<table style="border-collapse: collapse; border: 1px solid black;">';
	echo '<tr>';

	foreach ($display_text as $column) {
		echo '<th style="border: 1px solid black; padding: 5px;">' . $column['display'] . '</th>';
	}
	echo '</tr>';

	while ($row = mysqli_fetch_array($result)) {
		echo '<tr>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['course_id'] . '</td>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['course_name'] . '</td>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['department'] . '</td>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['grade'] . '</td>';
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['credits'] . '</td>';
		$row['category'] == 'Required' ? "必修" : "選修";
		echo '<td style="border: 1px solid black; padding: 5px;">' . $row['category'] . '</th>';
		form_selectable_cell(filter_value("Unfollow", "", 'unfollow.php?action=unfollow&id=' . $row['course_id'] . '&student_id=' . $student_id . '&credits=' . $row['credits']), "Unfollow");
		echo '</tr>';
	}
	
	echo '</table>';

	



	// while($row = mysqli_fetch_array($result)){

	// 	form_selectable_cell($row['course_id'] , $row['course_id']);
	// 	form_selectable_cell($row['course_name'], $row['course_name']);
	// 	form_selectable_cell($row['department'], $row['department']);			
	// 	form_selectable_cell($row['grade'], $row['grade']);
	// 	form_selectable_cell($row['credits'], $row['credits']);			
	// 	form_selectable_cell(($row['category'] == 'Required' ? "必修" : "選修"), $row['category']);		
	// 	form_selectable_cell(filter_value("Unfollow", "", 'follow.php?action=follow&id=' . $row['course_id'] . '&student_id=' . $MyHead . '&credits=' . $row['credits']), "Unfollow");		
	// 	form_end_row();
	// }
	html_end_box(false);



	//Student Could Withdraw Courses
	
	//select total_credits
	$sql = "select total_credits from student where student_id = \"$student_id\""; 
	$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
	$row = mysqli_fetch_array($result);
	$total_credits = $row['total_credits'];

	$under_selected = 0;


	//處理退關注時的boundary問題
		$sql = "select course_id, course_name, department, grade, credits
				from course 
				where course_id in (select course_id from followed_course
					where student_id = \"$student_id\") and category = \"Elective\"";	

	$result = mysqli_query($conn, $sql) or die('MySQL query error');

}


?>


<?php
$conn->close();
?>