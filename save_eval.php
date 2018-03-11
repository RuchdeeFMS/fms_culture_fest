<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }

    include_once 'assets/php/dbconnect.php';
    include_once 'assets/php/evaluation.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    $evaluation = new Evaluation($db);

    // zone 9 = evaluation form
    $zone_no = 9;
    $evaluation->id = $_SESSION['id_card'];
    // $evaluation->q1_res = $_POST['q1_res'];
    $evaluation->q1_res = 5;

    //$evaluation->create();

    // insert into evaluation table
    if ($evaluation->create()) {
        // update participant_zones table
        header("Location: scan_qr.php?zone=9");
    } else {
        // insert error
        header("Location: error.php?error_no=11");
    }

?>
