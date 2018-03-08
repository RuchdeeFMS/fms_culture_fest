<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }

    $id = $_SESSION['id_card'];
    $zone_no = $_REQUEST["zone"];
    if (isset($_REQUEST["completed"]) && $_REQUEST["completed"] == 1) {
        $isCompleted = 1;
    } else {
        $isCompleted = 0;
    }
    if (isset($_REQUEST["scanned"]) && $_REQUEST["scanned"] == 1) {
        $isScanned = 1;
    } else {
        $isScanned = 0;
    }

    include_once 'assets/php/dbconnect.php';
    include_once 'assets/php/participant_zone.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    $participant_zone = new Participant_Zone($db);

    $participant_zone->id = $id;
    $result = $participant_zone->readone();
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ตลาดนัดวัฒนธรรม - คณะวิทยาการจัดการ</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:400,700'>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Athiti|Sriracha&amp;subset=thai" rel="stylesheet">
        <style>
            .logo-main { font-family: 'Sriracha', cursive; }
            p, span, h2, h3, button { font-family: 'Athiti', sans-serif; }
        </style>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Header -->
        <div class="container">
            <div class="row header">
                <div class="col-sm-4 logo">
                    <h1><a href="index.php" class="logo-main">ตลาดนัดวัฒนธรรม คณะวิทยาการจัดการ</a></h1>
                </div>
                <div class="col-sm-8 call-us">
                    <p><span><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?></span> | <a href="assets/php/signout.php"><i class="fa fa-sign-out"></i> ออกจากระบบ (Sign Out)</a></p>
                </div>
            </div>
        </div>

        <!-- Coming Soon -->
        <div class="coming-soon">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                                if ($isScanned) {
                                    echo "<h2>คุณได้เข้าร่วมกิจกรรมโซน " . $zone_no . " แล้ว</h2>";
                                }
                                if ($isCompleted) {
                                    echo "<h2>ขอบคุณสำหรับการเข้าร่วมกิจกรรมโซน " . $zone_no . "</h2>";
                                }
                                if ($row['all_zones']) {
                                    echo "<h3>ขอแสดงความยินดี! คุณได้เข้าร่วมกิจกรรมครบทุกโซนแล้ว</h3>";
                                    echo "<h3>ขั้นตอนสุดท้าย คลิกปุ่มด้านล่างเพื่อประเมินกิจกรรม</h3>";
                                    echo "<button class='btn btn-primary btn-lg' onclick=''>คลิกเพื่อประเมินกิจกรรม</button>";
                                }
                            ?>
                            <!-- <span><i class="fa fa-thumbs-o-up fa-5x" style="color:green;"></i>
                            <p>คุณได้รับทรานสคริปต์ 3 ชั่วโมงจากการเข้าร่วมกิจกรรมตลาดนัดวัฒนธรรมทั้ง 6 โซน</p></span> -->

                            <div class="timer">
                                <div class="days-wrapper" <?php if ($row['zone_1']) { echo "style='background-color:red;'";} ?> >
                                    <span class="days">ลงทะเบียน (Registration)</span><br>
                                    <?php
                                        if ($row['zone_1']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_2']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 2 - เวที <br />(Zone 2 - Stage)</span><br>
                                    <?php
                                        if ($row['zone_2']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_3']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 3 - ตะลุง <br /> (Zone 3 - Talung)</span><br>
                                    <?php
                                        if ($row['zone_3']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_4']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 4 - เล่น <br /> (Zone 4 - Play)</span><br>
                                    <?php
                                        if ($row['zone_4']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_5']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 5 - สาธิต <br /> (Zone 5 - Learn)</span><br>
                                    <?php
                                        if ($row['zone_5']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_6']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 6 - กิน <br /> (Zone 6 - Eat)</span><br>
                                    <?php
                                        if ($row['zone_6']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_7']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 7 - กิน <br /> (Zone 7 - Eat)</span><br>
                                    <?php
                                        if ($row['zone_7']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_8']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 8 - กิน <br /> (Zone 8 - Eat)</span><br>
                                    <?php
                                        if ($row['zone_8']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_9']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">ประเมินกิจกรรม <br /> (Evaluation)</span><br>
                                    <?php
                                        if ($row['zone_9']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="container">
            <!-- <div class="row">
                <div class="col-sm-12 subscribe">
                    <h3>Subscribe to our newsletter</h3>
                    <p>Sign up now to our newsletter and you'll be one of the first to know when the site is ready:</p>
                    <form class="form-inline" role="form" action="assets/subscribe.php" method="post">
                    	<div class="form-group">
                    		<label class="sr-only" for="subscribe-email">Email address</label>
                        	<input type="text" name="email" placeholder="Enter your email..." class="subscribe-email form-control" id="subscribe-email">
                        </div>
                        <button type="submit" class="btn">Subscribe</button>
                    </form>
                    <div class="success-message"></div>
                    <div class="error-message"></div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-sm-12 social">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Dribbble"><i class="fa fa-dribbble"></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="FMS Website"><i class="fa fa-at"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span>Copyright © 2018 สาขาระบบสารสนเทศทางธุรกิจ ภาควิชาบริหารธุรกิจ คณะวิทยาการจัดการ. All Rights Reserved.</span>
                </div>
            </div>
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <!-- <script src="assets/js/jquery.countdown.min.js"></script> -->
        <script src="assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>