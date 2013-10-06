
<?php include '/database/init.php'; ?>
<?php
$output = "";
//collect

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

            $output .= '<div> ' . $fname . ' ' . $lname . '</div>';
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

                <?php print $output ?>

            </div><!-- end #content-->

            <div id="search">
                <input type="text" value="Search" placeholder="Search...">
            </div><!-- end #search-->

            <div id="sidebar">
                <h3>Rubrik</h3>
            </div><!-- end #sidebar-->

            <div id="footer">
                <p>&COPY; Gefle Underground</p>
            </div>


        </div><!-- end #wrapper-->
    </body>
</html>
