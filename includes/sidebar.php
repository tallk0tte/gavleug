<div id="login">
    <?php
    //Om man är inloggad, visa det här
    if (logged_in() === true ) {
        include 'includes/loggedin.php';
        ?>
        <input type="button" value="Newsfeed" id="button" onClick="location.href='newsfeed.php'">
        <input type="button" value="Add event" id="button" onClick="location.href='addEvent.php'">
        <input type="button" value="Upload Image" id="button" onClick="location.href='upload.php'">
        <input type="button" value="Logout" id="button" onClick="location.href='logout.php'">
        
        <?php
    } else {
        //om du inte är inloggad, visa det här:
        include 'includes/loginform.php';
    }
    ?>
</div><!-- end #sidebar -->
