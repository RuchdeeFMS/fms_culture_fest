<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        if (isset($_REQUEST["zone"])) {
            //header("Location: login.php?zone=" . $_REQUEST["zone"]);
            header("Location: https://www.yahoo.com");
        } else {
            header("Location: https://www.facebook.com");
        }

    } else {
        header("Location: https://www.facebook.com");
    }

?>
