<?php
include 'database/init.php';

$showmonth = $_POST['showmonth'];
$showyear = $_POST['showyear'];
$showmonth = preg_replace('#[^0-9]#i', '', $showmonth);
$showyear = preg_replace('#[^0-9]#i', '', $showyear);

$day_count = cal_days_in_month(CAL_GREGORIAN, $showmonth, $showyear);
$pre_days = date('w', mktime(0, 0, 0, $showmonth, 1, $showyear));
$post_days = (6 - (date('w', mktime(0,0,0,$showmonth, $day_count, $showyear))));


echo '<div id="calendar_wrap">';
echo '<div class="title_bar">';
echo '<div class="previous_month"><input type="submit" id="calButton" name="myBtn" value="Previous Month" onClick="javascript:prev_month();"></div>';
echo '<div class="show_month">Date: ' . $showmonth . '/' . $showyear . '</div>';
echo '<div class="next_month"><input type="submit" id="calButton" name="myBtn" value="Next Month" onClick="javascript:next_month();"></div>';
echo '</div>';





/* Current month */
for($i=1; $i<=$day_count; $i++) {
    $date = $showmonth .'/'.$i.'/'.$showyear;
    $query = mysql_query('SELECT id FROM events WHERE evdate = "'.$date. '"');
    $num_rows = mysql_num_rows($query);
    if($num_rows > 0){
        $event = "<input type='submit' name='$date' value='Event' id='$date' class='evButton' onclick='javascript:show_details(this);'>";
    }
    
    //end get events
    echo '<div class="cal_day">';
    echo '<div class="day_heading">' . $i  . '</div>';
    //show events button
    if($num_rows != 0) {
        echo "<div class='openings'><br>" . $event . "</div>";
    }
    echo '</div>';
}
echo '</div>';
?>
