<?php 
// Set current date
$date = '06/29/2014';
// Parse into a Unix timestamp
$ts = strtotime($date);
// Find the year and the current week
$year = date('o', $ts);
$week = date('W', $ts);
?>
<?php

    function dayOfWeek($dayNumber) {
        return strtotime($year . '-W' . $week . '-' . $dayNumber);
    }        

    echo "<table class='weekly'><thead><tr>";
    for($weekdayNo = 1; $weekdayNo <= 7; $weekdayNo++){
        echo "<th>" . $dage[$weekdayNo] . " ". date("j/m", dayOfWeek($weekdayNo)) . "</th>";
    }             

    echo "</tr></thead><tbody><tr>";
    for($weekdayNo = 1; $weekdayNo <= 7; $weekdayNo++) {
        echo "<td"; 
        if($weekdayNo == 7) { echo " class='last'"; } 
        echo ">";
        $day = date("Y-m-d", dayOfWeek($weekdayNo));
        if(isset($entries[$day])) {
            foreach($entries[$day] as $entry) {
                echo "<div class='workEntry' title='" . $entry->note . "'><span>";
                echo date("H:i", strtotime($entry->workStart));
                if($entry->workStart != "0000-00-00 00:00:00") { 
                    echo " - " . date("H:i", strtotime($entry->workEnd)); 
                } 
                echo "</span><span>";
                if($entry->userId == 0) {
                    echo "Unspecifed";
                }
                else {
                    echo $entry->name . "," . $entry->pgroup;
                }    
                echo "</span></div>";               
            }
        } 
        echo "</td>";
    }         
    echo "</tr></tbody></table>";
?>