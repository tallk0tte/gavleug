<?php
$deets = $_POST['deets'];
$deets = preg_replace('#[^0-9/]#i', '', $deets);

include 'database/init.php';

$events = '';
$query = mysql_query('SELECT * FROM events WHERE evdate = "'.$deets.'"');
$num_rows = mysql_num_rows($query);
if($num_rows > 0) {
    //Skriver ut rubrik och datum
    $events .= '<div id="eventsControl"><button onMouseDown="overlay()">Close</button><br><br><h1>Gefle Underground - Events:</h1><br><b>' .$deets. '</b> <br><br></div>';
    
    while($row = mysql_fetch_array($query)) {
        $desc = $row['description'];
        $title = $row['title'];
        //Skriver ut title och description
        $events .= '<div id="eventsBody"><b>'. $title . '</b><br><br>' . $desc . '<br><hr><br></div>';
    }
}

echo $events;
?>
