<?php include '/database/init.php'; ?>

<?php
//Sökfunktion
$output = "";

//Hämta information från databasen
if (isset($_POST['search'])) {
    $searchq = $_POST['search'];

    $query = mysql_query("SELECT * FROM newsfeed WHERE news_namn LIKE '%$searchq%'") or die("Could not search!");
    $count = mysql_num_rows($query);

    if ($count == 0) {
        $output = "There was no search results!";
    } else {
        while ($row = mysql_fetch_array($query)) {
            $news_namn = $row['news_namn'];
            $news_text = $row['news_text'];

            $output .= '<div><p><strong><u>' .$news_namn . '</u></strong><br>' . $news_text. '</p></div><br>' ;
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title>Webbprojekt</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="css/images/favoicon.ico" >
    </head>
    <body>
        <div id="wrapper">

            <div id="header">

            </div><!-- end #header-->

            <?php include 'includes/menu.php'; ?>
            <?php include 'includes/sidebar.php'; ?>

            <div id="content">
                
                
                <?php
                if(isset($_POST['search'])){
                    echo '<h1>Your search results</h1>';
                    echo $output;
                } else {
                ?>
                
                <h1><center>Nyhetsflödet</center></h1>
                <br>
                <?php
                 if (mysql_connect('localhost', 'root', '') && mysql_select_db('gavleug')) {
                     //Hämtar data från databasen och sorterar efter datum/senaste inlägg.
                    $entries = mysql_query("SELECT `news_date`, `news_namn`, `news_text` FROM newsfeed ORDER BY `news_date` DESC");
                    
                    if(mysql_num_rows($entries)==0){
                        echo 'No entries yet!';
                    }
                    else{
                        while($entry_row = mysql_fetch_assoc($entries)){
                            $entries_date = date('D M Y @ h:i:s', $entry_row['news_date']);
                            $entries_namn = $entry_row['news_namn'];
                            $entries_text = $entry_row['news_text'];
                            
                            echo '<p><strong> '.$entries_namn.' on '.$entries_date.'</strong>:<br>'.$entries_text.' </p>';
                            echo '<br>';
                        }
                    }
                } else {
                    echo 'Could not connect at this time';
                }
                
                }
                
                ?>
                
                
            </div><!-- end #content-->

            <div id="search">
                <form action="" method="POST">
                <input type="text" name="search" placeholder="Search...">
                </form>
            </div><!-- end #search-->

            <div id="sidebar">
                <?php include 'includes/sidebarcontent.php'; ?>
            </div><!-- end #sidebar-->

            <div id="footer">
                <p>&COPY; Gefle Underground</p>
            </div>


        </div><!-- end #wrapper-->
    </body>
</html>
