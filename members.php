<?php include '/database/init.php'; ?>


<?php
/* Sökfunktion */
$output = "";

//Hämta information
if (isset($_POST['search'])) {
    $searchq = $_POST['search'];

    $query = mysql_query("SELECT * FROM users WHERE user_fname LIKE '%$searchq%' OR user_ename LIKE '%$searchq%'") or die("Could not search!");
    $count = mysql_num_rows($query);

    if ($count == 0) {
        $output = "There was no search results!";
    } else {
        while ($row = mysql_fetch_array($query)) {
            $fname = $row['user_fname'];
            $lname = $row['user_ename'];

            $output .= '<div>' .$fname . ' ' . $lname. '</div>' ;
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
                    <h1><center>Registrerade medlemmar</center></h1>
                    <br>
                    <?php
                    //Hämtar, sorterar och skriver ut 
                    if (mysql_connect('localhost', 'root', '') && mysql_select_db('gavleug')) {
                        $entries = mysql_query("SELECT `user_id`, `username`, `user_fname`, `user_ename`, `user_email` FROM users ORDER BY `user_id` DESC");

                        if (mysql_num_rows($entries) == 0) {
                            echo 'No Members!';
                        } else {
                            while ($entry_row = mysql_fetch_assoc($entries)) {
                                $entries_username = $entry_row['username'];
                                $entries_email = $entry_row['user_email'];


                                echo 'Username: ' . $entries_username . '<br>';
                                echo 'Email: ' . $entries_email . '';
                                echo '<br><br>';
                            }
                        }
                    } else {
                        echo 'Could not connect at this time';
                    }
                }
                ?>


            </div><!-- end #content-->

            <div id="search">
                <form action="" method="post">
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
