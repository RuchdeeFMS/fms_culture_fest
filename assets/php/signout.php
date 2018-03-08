<?php
    session_start();
    // clear student's session variables
    if (isset($_SESSION['username'])) {
        session_destroy();
        //session_unset();
        unset($_SESSION['username']);
        unset($_SESSION['id_card']);
        header("Location: ../../login.php");
    }

?>
