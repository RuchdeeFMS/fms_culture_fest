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

    $evaluation->id = $_SESSION['id_card'];
    $evaluation->q1_1 = $_POST['res-type'];
    if ($_POST['res-type'] != "วจก" && $_POST['res-type'] != "คณะอื่น") {
        $evaluation->q1_1_major = "";
    } else {
        if ($_POST['res-type'] == "วจก") {
            $evaluation->q1_1_major = $_POST['res-major'];
        }
        if ($_POST['res-type'] == "คณะอื่น") {
            $evaluation->q1_1_major = $_POST['res-fac'];
        }
    }
    $evaluation->q1_2 = "";
    foreach ($_POST['res-fav'] as $fav) {
      if ($fav == true) {
        $evaluation->q1_2 = $evaluation->q1_2 . $fav . ",";
      }
    }
    $evaluation->q2_1 = $_POST['res-sat2-1'];
    $evaluation->q2_2 = $_POST['res-sat2-2'];
    $evaluation->q2_3 = $_POST['res-sat2-3'];
    $evaluation->q2_4 = $_POST['res-sat2-4'];
    $evaluation->q2_5 = $_POST['res-sat2-5'];
    $evaluation->q2_6 = $_POST['res-sat2-6'];
    $evaluation->q2_7 = $_POST['res-sat2-7'];
    $evaluation->q2_8 = $_POST['res-sat2-8'];
    $evaluation->q2_9 = $_POST['res-sat2-9'];
    $evaluation->q3 = $_POST['res-suggest'];

    // set current timezone
    date_default_timezone_set("Asia/Bangkok");
    $evaluation->eval_ts = date("Y/m/d H:i:s");

    // zone 9 = evaluation form
    $zone_no = 9;

    // insert into evaluation table
    if ($evaluation->create()) {
        // update participant_zones table
        header("Location: scan_qr.php?zone=" . $zone_no);
        exit;
    } else {
        // insert error
        header("Location: error.php?error_no=13");
        exit;
    }

?>
