<?php include 'database/init.php'; ?>

<?php
//Sökfunktion
$output = "";

//Hämta information från sökningen
if (isset($_POST['search'])) {
    $searchq = $_POST['search'];

    $query = mysql_query("SELECT * FROM events WHERE title LIKE '%$searchq%'") or die("Could not search!");
    $count = mysql_num_rows($query);

    if ($count == 0) {
        $output = "There was no search results!";
    } else {
        while ($row = mysql_fetch_array($query)) {
            $title = $row['title'];
            $description = $row['description'];
            //Skriver ut title och description
            $output .= '<div><p><strong><u>' .$title . '</u></strong><br>' . $description . '</p></div><br>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title>Webbprojekt</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all">
        <link rel="shortcut icon" href="css/images/favoicon.ico" >
        <script language="JavaScript" type="text/javascript" src="js/calendar.js"></script>
    </head>
    <body onLoad="initialCalendar();">
        <div id="wrapper">

            <div id="header">

            </div><!-- end #header-->

            <?php include 'includes/menu.php'; ?>
            <?php include 'includes/sidebar.php'; ?>

            <div id="content">
                <?php
                //Om användaren har använt sökt så visa upp detta
                if (isset($_POST['search'])) {
                    ?> 
                <h1>You search results...</h1>
                <br>
                
                    <?php
                    echo $output;
                } else {
                    
                    //Annars, vissa upp det här (Det nedanför)
                    ?>
                <div id="showCalendar"></div>
                <div id="overlay">
                    <div id="events"></div>
                </div>
                <?php
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
