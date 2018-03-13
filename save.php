<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        if (isset($_REQUEST["zone"])) {
            header("Location: login.php?zone=" . $_REQUEST["zone"]);
            exit;
        } else {
            header("Location: error.php?error_no=11");
            exit;
        }
    }

    include_once 'assets/php/dbconnect.php';
    include_once 'assets/php/participant.php';
    include_once 'assets/php/participant_zone.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    $participant = new Participant($db);
    $participant_zone = new Participant_Zone($db);

    $zone_no = $_REQUEST["zone"];
    $id = $_SESSION['id_card'];
    //$curr_time = date();

    // find current latitude and longitude
    $glat = $_REQUEST["clat"];
    $glong = $_REQUEST["clong"];
    $participant_zone->latitude = $glat;
    $participant_zone->longitude = $glong;

    $participant->id = $id;
    $participant_zone->id = $id;

    // set current timezone
    date_default_timezone_set("Asia/Bangkok");
    $participant_zone->cdate = date("Y/m/d H:i:s");

    // 1. check id in participants table
    if (!$participant->find_id()) {
        // 2. if not exist, add id & username into participants table
        $participant->username = $_SESSION['username'];

        if ($participant->create()) {
            // 3. also insert into participants_zones table
            $participant_zone->zone = 0;
            if (!$participant_zone->create()) {
                // insert error (participant_zone)
                header("Location: error.php?error_no=3");
                exit;
            } else {
                // 4. update zone, timestamp, latitude, and longitude in participants_zones table
                if ($zone_no != 0) {
                    $participant_zone->zone = $zone_no;
                    if ($participant_zone->update()) {
                        // 5. back to main page & notify with just-scanned zone msg
                        header("Location: index.php?zone=" . $zone_no . "&completed=1");
                        exit;
                    } else {
                        // update error
                        header("Location: error.php?error_no=4");
                        exit;
                    }
                } else {
                    // back to main page & notify with just-scanned zone msg
                    header("Location: index.php?zone=" . $zone_no . "&completed=1");
                    exit;
                }
            }
        } else {
            // insert error (participant)
            header("Location: error.php?error_no=2");
            exit;
        }
    } else {
        // 6. check whether zone's qr code is already scanned
        $participant_zone->zone = $zone_no;
        if ($participant_zone->isScanned()) {
            // scanned already
            header("Location: index.php?zone=" . $zone_no . "&scanned=1");
            exit;
        } else {
            // 7. if not, update zone, timestamp, latitude, and longitude in participants_zones table
            if ($participant_zone->update()) {
                // 8. back to main page & notify with just-scanned zone msg
                header("Location: index.php?zone=" . $zone_no . "&completed=1");
                exit;
            } else {
                // update error
                header("Location: error.php?error_no=5");
                exit;
            }
        }
    }
?>
