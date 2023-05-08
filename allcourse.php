<a href = "homepage.php"> 回上頁(Homepage) </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');


	//select all course
	$sql = "select * from course"; 
	$result = mysqli_query($conn, $sql) or die('MySQL query error : select total_creedits ');	
	//$row = mysqli_fetch_array($result);
	

	//印出所有課程列表
	$result = mysqli_query($conn, $sql) or die('MySQL query error');
	html_start_box('******  所有課程列表  ******  ', '100%', '   ', '5', 'left', '   ');
	$display_text = array(
		array('display' => 'course_id',    'align' => 'left'),
		array('display' => 'Course Name',  'align' => 'left'),
		array('display' => 'Department',   'align' => 'left'),
		array('display' => 'Grade',        'align' => 'right'),
		array('display' => 'Credits',      'align' => 'right'),
		array('display' => 'Max People',   'align' => 'right'),
		array('display' => 'Current People','align' => 'right'),
		array('display' => 'Category',     'align' => 'right'),		
	);

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
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['department'] . '</td>';
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['grade'] . '</td>';
   			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['credits'] . '</td>';
			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['max_people'] . '</td>';
			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['current_people'] . '</td>';
			$row['category'] == 'Required' ? "必修" : "選修";
			echo '<td style="border: 1px solid black; padding: 5px;">' . $row['category'] . '</td>';
   			echo '</tr>';

			
		}
		echo '</table>';
		html_end_box(false);

?>


<?php
$conn->close();
?>