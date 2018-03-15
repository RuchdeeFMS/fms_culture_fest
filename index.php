<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
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
            p, span, h2, h3, h4, button, .panel { font-family: 'Athiti', sans-serif; }
            .modal-dialog { overflow-y: initial !important }
            .modal-body { height: 300px; overflow-y: auto; }
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
                                if ($isScanned && !$row['zone_9']) {
                                    if ($isScanned && $zone_no == 0) {
                                        echo "<h2>คุณได้ลงทะเบียนเรียบร้อยแล้ว</h2>";
                                    } elseif ($isScanned && $zone_no <= 4) {
                                        echo "<h2>คุณได้เข้าร่วมกิจกรรมโซน " . $zone_no . " แล้ว</h2>";
                                    } elseif ($isScanned && $zone_no > 4 && $zone_no < 9) {
                                        $czone = $zone_no - 1;
                                        echo "<h2>คุณได้เข้าร่วมกิจกรรมโซน " . $czone . " แล้ว</h2>";
                                    }
                                } elseif ($isScanned && $row['zone_9']) {
                                    echo "<span><i class='fa fa-thumbs-o-up fa-5x' style='color:green;'></i>
                                    <h3>ขอแสดงความยินดี! คุณได้เข้าร่วมกิจกรรมครบทุกโซน+ประเมินกิจกรรมแล้ว</h3></span>";
                                }
                                if ($isCompleted && $zone_no == 0) {
                                    echo "<h2>ขอบคุณสำหรับการเข้าร่วมกิจกรรมตลาดนัดวัฒนธรรม</h2>";
                                } elseif ($isCompleted && $zone_no <= 4) {
                                    echo "<h2>ขอบคุณสำหรับการเข้าร่วมกิจกรรมโซน " . $zone_no . "</h2>";
                                } elseif ($isCompleted && $zone_no > 4 && $zone_no < 9) {
                                    $czone = $zone_no - 1;
                                    echo "<h2>ขอบคุณสำหรับการเข้าร่วมกิจกรรมโซน " . $czone . "</h2>";
                                } elseif ($isCompleted && $zone_no == 9) {
                                    echo "<h2>ขอบคุณสำหรับการประเมินกิจกรรมตลาดนัดวัฒนธรรม</h2>";
                                }
                                if ($row['all_zones'] && !$row['zone_9']) {
                                    echo "<h3>ขอแสดงความยินดี! คุณได้เข้าร่วมกิจกรรมครบทุกโซนแล้ว</h3>";
                                    echo "<h3>ขั้นตอนสุดท้าย คลิกปุ่มด้านล่างเพื่อประเมินกิจกรรม</h3>";
                                    echo "<button class='btn btn-primary btn-lg' id='btnEval' data-toggle='modal' data-target='#evaluation-form'>ประเมินกิจกรรม</button>";
                                } elseif ($row['all_zones'] && $zone_no == 9) {
                                    echo "<h3>ขอแสดงความยินดี! คุณจะได้รับทรานสคิปต์จากการเข้าร่วมกิจกรรม 6 ชั่วโมง</h3>";
                                }
                            ?>
                            <!-- <span><i class="fa fa-thumbs-o-up fa-5x" style="color:green;"></i>
                            <p>คุณได้รับทรานสคริปต์ 3 ชั่วโมงจากการเข้าร่วมกิจกรรมตลาดนัดวัฒนธรรมทั้ง 6 โซน</p></span> -->

                            <div class="timer">
                                <div class="days-wrapper" <?php if ($row['zone_0']) { echo "style='background-color:red;'";} ?> >
                                    <span class="days">ลงทะเบียน (Registration)</span><br>
                                    <?php
                                        if ($row['zone_0']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_1']) { echo "style='background-color:red;'";} ?> >
                                    <span class="days">โซน 1 - ชุดไทย <br />(Zone 1 - Dress)</span><br>
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
                                    <span class="days">โซน 3 - ตลาด <br /> (Zone 3 - Market)</span><br>
                                    <?php
                                        if ($row['zone_3']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_4']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 4 - เกมส์#1 <br /> (Zone 4 - Games#1</span><br>
                                    <?php
                                        if ($row['zone_4']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_5']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 4 - เกมส์#2 <br /> (Zone 4 - Games#2)</span><br>
                                    <?php
                                        if ($row['zone_5']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_6']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 5 - โหนด-นา-เล <br /> (Zone 5 - Node-Na-Lay)</span><br>
                                    <?php
                                        if ($row['zone_6']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_7']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 6 - อาหาร <br /> (Zone 6 - Food)</span><br>
                                    <?php
                                        if ($row['zone_7']) {
                                            echo "<i class='fa fa-check-circle fa-4x'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle fa-4x'></i>";
                                        }
                                    ?>
                                </div>
                                <div class="days-wrapper" <?php if ($row['zone_8']) { echo "style='background-color:red;'";} ?>>
                                    <span class="days">โซน 7 - หัตถกรรม <br /> (Zone 7 - Craft)</span><br>
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
                    <a href="https://www.facebook.com/fmspsu/" data-toggle="tooltip" data-placement="top" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.youtube.com/channel/UCJgr5jHOOx9HCf6nG4lZbAg" data-toggle="tooltip" data-placement="top" title="YouTube" target="_blank"><i class="fa fa-youtube"></i></a>
                    <a href="http://www.fms.psu.ac.th/" data-toggle="tooltip" data-placement="top" title="FMS Website" target="_blank"><i class="fa fa-at"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span>Copyright © 2018 สาขาระบบสารสนเทศทางธุรกิจ ภาควิชาบริหารธุรกิจ คณะวิทยาการจัดการ. All Rights Reserved.</span>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="evaluation-form" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">แบบประเมินกิจกรรมออนไลน์</h4>
              </div>
              <form role="form" action="save_eval.php" method="post">
                <div class="modal-body">
                  <div class="panel panel-info">
                    <div class="panel-heading"><u>ตอนที่ 1</u> ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม</div>
                    <div class="panel-body">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label for="res-type" class="col-md-2">1.1.สถานภาพ</label>
                          <div class="col-md-5">
                            <input type="radio" class="radio-inline" id="res-type" name="res-type" value="วจก" checked> นักศึกษาคณะวิทยาการจัดการ</input>
                            <select name="res-major" id="res-major" class="form-control">
                              <option value="การเงิน" selected>สาขาการเงิน</option>
                              <option value="การตลาด">สาขาการตลาด</option>
                              <option value="บริหารทรัพยากรมนุษย์">สาขาบริหารทรัพยากรมนุษย์</option>
                              <option value="ระบบสารสนเทศทางธุรกิจ">สาขาระบบสารสนเทศทางธุรกิจ</option>
                              <option value="การจัดการโลจิสติกส์">สาขาการจัดการโลจิสติกส์</option>
                              <option value="การจัดการ(ภาษาอังกฤษ)">สาขาการจัดการ(ภาษาอังกฤษ)</option>
                              <option value="การจัดการประชุมฯ">สาขาการจัดการประชุมฯ</option>
                              <option value="ภาควิชาบัญชี">ภาควิชาบัญชี</option>
                              <option value="ภาควิชารัฐประศาสนศาสตร์">ภาควิชารัฐประศาสนศาสตร์</option>
                            </select>
                          </div>
                          <div class="col-md-5">
                            <input type="radio" class="radio-inline" id="res-type" name="res-type" value="คณะอื่น"> นักศึกษาคณะอื่นๆ (ระบุ) </input>
                            <input type="text" class="form-control" name="res-fac" id="res-fac" disabled />
                          </div>
                          <div class="col-md-2"></div>
                          <div class="col-md-5">
                            <input type="radio" class="radio-inline" id="res-type" name="res-type" value="อาจารย์และบุคลากร"> คณาจารย์และบุคลากรมหาวิทยาลัย</input>
                          </div>
                          <div class="col-md-5">
                            <input type="radio" class="radio-inline" id="res-type" name="res-type" value="บุคคลภายนอก"> บุคคลภายนอก</input>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="res-fav" class="col-md-2">1.2.โซนกิจกรรมที่ชื่นชอบ</label>
                          <div class="col-md-10">
                            <input type="checkbox" class="checkbox-inline" id="res-fav" name="res-fav[]" value="1"> โซน 1 อำนวยการและชุดไทย</input>
                            <input type="checkbox" class="checkbox-inline" id="res-fav" name="res-fav[]" value="2"> โซน 2 เวทีวัฒนธรรม</input>
                            <input type="checkbox" class="checkbox-inline" id="res-fav" name="res-fav[]" value="3"> โซน 3 ตลาดย้อนยุค</input><br />
                            <input type="checkbox" class="checkbox-inline" id="res-fav" name="res-fav[]" value="4"> โซน 4 เกมส์และการละเล่น</input>
                            <input type="checkbox" class="checkbox-inline" id="res-fav" name="res-fav[]" value="5"> โซน 5 โหนด นา เล</input>
                            <input type="checkbox" class="checkbox-inline" id="res-fav" name="res-fav[]" value="6"> โซน 6 อาหารพื้นบ้าน</input><br />
                            <input type="checkbox" class="checkbox-inline" id="res-fav" name="res-fav[]" value="7"> โซน 7 หัตถกรรมพื้นบ้าน</input>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-info">
                    <div class="panel-heading"><u>ตอนที่ 2</u> ระดับความพึงพอใจ</div>
                    <div class="panel-body">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label for="res-sat2-1" class="col-md-4">2.1.การประชาสัมพันธ์การจัดงาน</label>
                          <div class="col-md-8">
                            <input type="radio" class="radio-inline" id="res-sat2-1" name="res-sat2-1" value="5" required> มากที่สุด</input>
                            <input type="radio" class="radio-inline" id="res-sat2-1" name="res-sat2-1" value="4"> มาก</input>
                            <input type="radio" class="radio-inline" id="res-sat2-1" name="res-sat2-1" value="3"> ปานกลาง</input>
                            <input type="radio" class="radio-inline" id="res-sat2-1" name="res-sat2-1" value="2"> น้อย</input>
                            <input type="radio" class="radio-inline" id="res-sat2-1" name="res-sat2-1" value="1"> น้อยที่สุด</input>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="res-sat2-2" class="col-md-4">2.2.ความสะดวกในการลงทะเบียน</label>
                          <div class="col-md-8">
                            <input type="radio" class="radio-inline" id="res-sat2-2" name="res-sat2-2" value="5" required> มากที่สุด</input>
                            <input type="radio" class="radio-inline" id="res-sat2-2" name="res-sat2-2" value="4"> มาก</input>
                            <input type="radio" class="radio-inline" id="res-sat2-2" name="res-sat2-2" value="3"> ปานกลาง</input>
                            <input type="radio" class="radio-inline" id="res-sat2-2" name="res-sat2-2" value="2"> น้อย</input>
                            <input type="radio" class="radio-inline" id="res-sat2-2" name="res-sat2-2" value="1"> น้อยที่สุด</input>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="res-sat2-3" class="col-md-4">2.3.รูปแบบการจัดงานมีความเหมาะสม</label>
                          <div class="col-md-8">
                            <input type="radio" class="radio-inline" id="res-sat2-3" name="res-sat2-3" value="5" required> มากที่สุด</input>
                            <input type="radio" class="radio-inline" id="res-sat2-3" name="res-sat2-3" value="4"> มาก</input>
                            <input type="radio" class="radio-inline" id="res-sat2-3" name="res-sat2-3" value="3"> ปานกลาง</input>
                            <input type="radio" class="radio-inline" id="res-sat2-3" name="res-sat2-3" value="2"> น้อย</input>
                            <input type="radio" class="radio-inline" id="res-sat2-3" name="res-sat2-3" value="1"> น้อยที่สุด</input>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="res-sat2-4" class="col-md-4">2.4.เวลาที่ใช้ในการจัดงานมีความเหมาะสม</label>
                          <div class="col-md-8">
                            <input type="radio" class="radio-inline" id="res-sat2-4" name="res-sat2-4" value="5" required> มากที่สุด</input>
                            <input type="radio" class="radio-inline" id="res-sat2-4" name="res-sat2-4" value="4"> มาก</input>
                            <input type="radio" class="radio-inline" id="res-sat2-4" name="res-sat2-4" value="3"> ปานกลาง</input>
                            <input type="radio" class="radio-inline" id="res-sat2-4" name="res-sat2-4" value="2"> น้อย</input>
                            <input type="radio" class="radio-inline" id="res-sat2-4" name="res-sat2-4" value="1"> น้อยที่สุด</input>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="res-sat2-5" class="col-md-4">2.5.สถานที่จัดงาน (ความเรียบร้อยและความสะดวก)</label>
                          <div class="col-md-8">
                            <input type="radio" class="radio-inline" id="res-sat2-5" name="res-sat2-5" value="5" required> มากที่สุด</input>
                            <input type="radio" class="radio-inline" id="res-sat2-5" name="res-sat2-5" value="4"> มาก</input>
                            <input type="radio" class="radio-inline" id="res-sat2-5" name="res-sat2-5" value="3"> ปานกลาง</input>
                            <input type="radio" class="radio-inline" id="res-sat2-5" name="res-sat2-5" value="2"> น้อย</input>
                            <input type="radio" class="radio-inline" id="res-sat2-5" name="res-sat2-5" value="1"> น้อยที่สุด</input>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="res-sat2-6" class="col-md-4">2.6.พัฒนาทักษะการเรียนรู้ศิลปวัฒนธรรมและภูมิปัญญาไทย</label>
                          <div class="col-md-8">
                            <input type="radio" class="radio-inline" id="res-sat2-6" name="res-sat2-6" value="5" required> มากที่สุด</input>
                            <input type="radio" class="radio-inline" id="res-sat2-6" name="res-sat2-6" value="4"> มาก</input>
                            <input type="radio" class="radio-inline" id="res-sat2-6" name="res-sat2-6" value="3"> ปานกลาง</input>
                            <input type="radio" class="radio-inline" id="res-sat2-6" name="res-sat2-6" value="2"> น้อย</input>
                            <input type="radio" class="radio-inline" id="res-sat2-6" name="res-sat2-6" value="1"> น้อยที่สุด</input>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="res-sat2-7" class="col-md-4">2.7.บูรณาการการเรียนรู้ศิลปวัฒนธรรมและภูมิปัญญาไทย</label>
                          <div class="col-md-8">
                            <input type="radio" class="radio-inline" id="res-sat2-7" name="res-sat2-7" value="5" required> มากที่สุด</input>
                            <input type="radio" class="radio-inline" id="res-sat2-7" name="res-sat2-7" value="4"> มาก</input>
                            <input type="radio" class="radio-inline" id="res-sat2-7" name="res-sat2-7" value="3"> ปานกลาง</input>
                            <input type="radio" class="radio-inline" id="res-sat2-7" name="res-sat2-7" value="2"> น้อย</input>
                            <input type="radio" class="radio-inline" id="res-sat2-7" name="res-sat2-7" value="1"> น้อยที่สุด</input>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="res-sat2-8" class="col-md-4">2.8.สร้างความสัมพันธ์ระหว่างคณะกับนักศึกษา</label>
                          <div class="col-md-8">
                            <input type="radio" class="radio-inline" id="res-sat2-8" name="res-sat2-8" value="5" required> มากที่สุด</input>
                            <input type="radio" class="radio-inline" id="res-sat2-8" name="res-sat2-8" value="4"> มาก</input>
                            <input type="radio" class="radio-inline" id="res-sat2-8" name="res-sat2-8" value="3"> ปานกลาง</input>
                            <input type="radio" class="radio-inline" id="res-sat2-8" name="res-sat2-8" value="2"> น้อย</input>
                            <input type="radio" class="radio-inline" id="res-sat2-8" name="res-sat2-8" value="1"> น้อยที่สุด</input>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="res-sat2-9" class="col-md-4">2.9.ความพึงพอใจในภาพรวมของการจัดโครงการ</label>
                          <div class="col-md-8">
                            <input type="radio" class="radio-inline" id="res-sat2-9" name="res-sat2-9" value="5" required> มากที่สุด</input>
                            <input type="radio" class="radio-inline" id="res-sat2-9" name="res-sat2-9" value="4"> มาก</input>
                            <input type="radio" class="radio-inline" id="res-sat2-9" name="res-sat2-9" value="3"> ปานกลาง</input>
                            <input type="radio" class="radio-inline" id="res-sat2-9" name="res-sat2-9" value="2"> น้อย</input>
                            <input type="radio" class="radio-inline" id="res-sat2-9" name="res-sat2-9" value="1"> น้อยที่สุด</input>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-info">
                    <div class="panel-heading"><u>ตอนที่ 3</u> ข้อคิดเห็นและข้อเสนอแนะ</div>
                    <div class="panel-body">
                      <div class="form-group">
                        <textarea class="form-control" id="res-suggest" name="res-suggest"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default" id="btnSubmit">ส่งแบบประเมิน</button>
                </div>
              </form>
            </div>
          </div>
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <!-- <script src="assets/js/jquery.countdown.min.js"></script> -->
        <script src="assets/js/scripts.js"></script>
        <script>
          $(document).ready(function() {
            $('input[type=radio][name=res-type]').on('change', function() {
              if (this.value == 'วจก') {
                $("#res-major").prop("disabled", false);
              } else {
                $("#res-major").prop("disabled", true);
              }
              if (this.value == 'คณะอื่น') {
                $("#res-fac").prop("disabled", false);
                $("#res-fac").prop("required", true);
              } else {
                $("#res-fac").prop("disabled", true);
                $("#res-fac").prop("required", false);
              }
            });
          });
        </script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->


    </body>

</html>
