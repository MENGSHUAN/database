<a href = "homepage.php"> 回上頁(Homepage) </a> <p>
<?php
include_once('db.php');
include_once('html.php');
include_once('html_utility.php');
session_start();
$array = array(1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5=>'Fri');
$idx = array(0=> "color:White", 1 => 'color:Cyan', 2 => 'color:Red', 3 => 'color:Green', 4 => 'color:DarkGrey', 5=>'color:Orange',
				6 => 'color:Black', 7 => 'color:Chocolate', 8 => 'color:Brown', 9 => 'color:BlueViolet', 10=>'color:GreenYellow',
				11 => 'color:Gold', 12 => 'color:SteelBlue', 13 => 'color:MediumSeaGreen', 14 => 'color:Navy', 15=>'color:Olive',
				16 => 'color:Tomato', 17 => 'color:Salmon', 18 => 'color:Maroon', 19 => 'color:Purple', 20=>'color:Peru');

for ($i = 1; $i <= 11; $i++) {
      for($j=1; $j <=5; $j++){
             $table[$i][$j] = "";
             $color[$i][$j] = $idx[0];
      }    
}

	if(isset($_SESSION["student_id"])) {
		$MyHead=$_SESSION["student_id"];	


		// select course_name  	
        $sql="select course_name, course_id, time_slot_id from course where course_id in (select course_id from selected_course where student_id = \"$MyHead\")";
 		$result = mysqli_query($conn, $sql) or die('MySQL query error : select course name , id ');
		//echo $sql;

		while($row = mysqli_fetch_array($result)){
		
			$slot_id = $row['time_slot_id'];

			// select day, time accoring to time_slot_id			
	        $sql1="select time_slot_id, time_day, start_time, end_time  from time_slot where time_slot_id = \"$slot_id\"";
			$result1 = mysqli_query($conn, $sql1) or die('MySQL query error : query time_slot_id ');	
			$row1 = mysqli_fetch_array($result1);
			
        
            $day = $row1['time_day'];
            
            $num1 = $row1['start_time'];   
            $num3 = $row1['end_time'];               
            if($num3 - $num1 ==2){
             	$num2 = $num1 + 1;               
           	}
            
            $key = array_search($day, $array);     
 			//echo  "  " . $slot_id . "  " . $num1 . "  " . $day . "  " .     $key . "  ";   
 
            $table[$num1][$key] = $row['course_name'];
            
            $table[$num3][$key] = $row['course_name'];
            $color[$num1][$key] = $idx[$slot_id];
            $color[$num3][$key] = $idx[$slot_id];
	            
            
            if($num3 - $num1 ==2){         
	            $table[$num2][$key] = $row['course_name'];
	            $color[$num2][$key] = $idx[$slot_id];
        	}    
        
        }

		//print_r($table);

		$result = mysqli_query($conn, $sql) or die('MySQL query error');
		html_start_box('******  我的課表  ******  ', '100%', '   ', '5', 'left', '   ');

		$display_text = array(
			array('display' => '        ', 'align' => 'left'),		
			array('display' => 'Monday  ', 'align' => 'left'),
			array('display' => 'Tuesday ', 'align' => 'left'),
			array('display' => 'Wednsday', 'align' => 'left'),
			array('display' => 'Thursday', 'align' => 'left'),
			array('display' => 'Friday  ', 'align' => 'left'),
		);
		//html_header($display_text, 2, false);
		echo '<table style="border-collapse: collapse; border: 1px solid black;">';
  		echo '<tr>';

  		foreach ($display_text as $column) {
   			echo '<th style="border: 1px solid black; padding: 5px;">' . $column['display'] . '</th>';
  		}
  		echo '</tr>';


		for ($i = 1; $i <= 11; $i++) {

			echo '<td style="border: 1px solid black; padding: 5px; width: 20px; height: 50px; color: blue">' .$i. '</td>';
			echo '<td style="border: 1px solid black; padding: 5px; width: 120px; height: 50px;' . $color[$i][1] . '">' .$table[$i][1]. '</td>';
			echo '<td style="border: 1px solid black; padding: 5px; width: 120px; height: 50px;' . $color[$i][2] . '">' .$table[$i][2]. '</td>';		
			echo '<td style="border: 1px solid black; padding: 5px; width: 120px; height: 50px;' . $color[$i][3] . '">' .$table[$i][3]. '</td>';			
			echo '<td style="border: 1px solid black; padding: 5px; width: 120px; height: 50px;' . $color[$i][4] . '">' .$table[$i][4]. '</td>';	
			echo '<td style="border: 1px solid black; padding: 5px; width: 120px; height: 50px;' . $color[$i][5] . '">' .$table[$i][5]. '</td>';			
			
			form_end_row();
		}
		html_end_box(false);

	}
?>
