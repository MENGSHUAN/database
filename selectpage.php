<a href = "homepage.php"> 回上頁(Homepage) </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');
session_start();
$MyHead=$_SESSION["student_id"];

if(isset($_SESSION["student_id"])) {
		

	//select total_credits
	$sql = "select total_credits from student where student_id = \"$MyHead\""; 
	$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
	$row = mysqli_fetch_array($result);
	$total_credits = $row['total_credits'];
	

	$over_selected = 0;
	
	//處理加選時的boundary問題
	if ( (30 - $total_credits) >= 3) { 
		$sql = "select course_id, course_name, department, grade, credits, max_people, current_people, category, time_slot_id 
		from course
		where current_people < max_people
		and (course_id ) not in (select course_id from selected_course 
				where student_id = \"$MyHead\" )
		and (time_slot_id) not in (select time_slot_id from course
				where course_id in (select course_id
									from selected_course
									where student_id = \"$MyHead\"))
		and (course_name) not in (SELECT course_name from course
								 WHERE course_id in (SELECT course_id
												   from selected_course
												   where student_id = \"$MyHead\" ))
		and ((department) in (SELECT department from student
							where student_id = \"$MyHead\") or
							(department = 'General Education'))";		
	} else if ((30 - $total_credits) == 2) {
		$sql = "select course_id, course_name, department, grade, credits, max_people, current_people, category, time_slot_id
			from course
			where (current_people < max_people and credits = 2)
			and (course_id ) not in (select course_id from selected_course 
					where student_id = (select student_id from student
					where student_id = \"$MyHead\" ))
			and (time_slot_id) not in(select time_slot_id from course
					where course_id in (select course_id
										from selected_course
										where student_id = \"$MyHead\"))
			and (course_name) not in (select course_name from course
										where course_id in (select course_id
														  	from selected_course
														  	where student_id = \"$MyHead\" ))
			and ((department) in (SELECT department from student
								   where student_id = \"$MyHead\") or
								   (department = 'General Education'))";	
	} else {
		$over_selected = 1;				
	}



	//印出我的可選課程列表
	$result = mysqli_query($conn, $sql) or die('MySQL query error');
	html_start_box('******  我的可選課程列表  ******  ', '100%', '   ', '5', 'left', '   ');
	$display_text = array(
		array('display' => 'course_id',             'align' => 'left'),
		array('display' => 'Course Name',         'align' => 'left'),
		array('display' => 'Department',       'align' => 'left'),
		array('display' => 'Grade',     'align' => 'right'),
		array('display' => 'Credits', 'align' => 'right'),
		array('display' => 'Max People',   'align' => 'right'),
		array('display' => 'Current People',   'align' => 'right'),
		array('display' => 'Category',   'align' => 'right'),
		array('display' => 'time_slot_id', 'align' => 'right'),
		//array('display' => 'Action',   'align' => 'left'),
		//array('display' => 'Function',   'align' => 'left'),
	);

	if ($over_selected == 1) {

			echo "已達到學分上限，不能再加選囉 !!";

	} else {
		echo '<table style="border-collapse: collapse; border: 1px solid black;">';
  		echo '<tr>';

  		foreach ($display_text as $column) {
   			echo '<th style="border: 1px solid black; padding: 5px;">' . $column['display'] . '</th>';
  		}
  		echo '</tr>';
		//html_header($display_text, 2, false);

		while($row = mysqli_fetch_array($result)){
			echo '<tr>';
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['course_id'] . '</td>';
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['course_name'] . '</td>';
   			echo '<td style="border: 1px solid black; padding: 5px; width: 130px;">' . $row['department'] . '</td>';
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['grade'] . '</td>';
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['credits'] . '</td>';
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['max_people'] . '</td>';
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['current_people'] . '</td>';
   			$row['category'] == 'Required' ? "必修" : "選修";
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['category'] . '</td>';
			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['time_slot_id'] . '</td>';

			//echo '<td style="border: 1px solid black; padding: 5px;">';
   			form_selectable_cell(filter_value("Add", "", 'add.php?action=add&id=' . $row['course_id'] . '&student_id=' . $MyHead . '&credits=' . $row['credits']), "Add");
			echo '<br>';
		    form_selectable_cell(filter_value("Follow", "", 'follow.php?action=follow&id=' . $row['course_id'] . '&student_id=' . $MyHead . '&credits=' . $row['credits']), "Follow");
			//echo '</td>';

			echo '</tr>';		
			form_end_row();
		}
		html_end_box(false);
	}	

}
?>


<?php
$conn->close();
?>