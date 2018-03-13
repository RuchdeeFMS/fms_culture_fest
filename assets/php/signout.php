<?php
    session_start();
    // clear student's session variables
    if (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
        unset($_SESSION['id_card']);
        session_destroy();
        //session_unset();
        header("Location: ../../login.php");
    } else {
        header("Location: ../../login.php");
    }

?>
