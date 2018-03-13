<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Error | ตลาดนัดวัฒนธรรม - คณะวิทยาการจัดการ</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:400,700'>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Athiti|Sriracha&amp;subset=thai" rel="stylesheet">
        <style>
            .logo-main { font-family: 'Sriracha', cursive; }
            p, span, h2, h3, h4, button { font-family: 'Athiti', sans-serif; }
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
                            <h2 style="color:red;">พบข้อผิดพลาด!</h2>
                            <span><i class="fa fa-exclamation-circle fa-5x" style="color:red;"></i><p style="color:red;">กรุณาติดต่อเจ้าหน้าที่โซนลงทะเบียน</p></span>
                            <?php
                                $error_no = $_REQUEST["error_no"];
                                switch ($error_no) {
                                  case 1:
                                      echo "<div style='color:black;'>[Error file name: login_process.php; Error line no: 20]</div>";
                                      break;
                                  case 2:
                                      echo "<div style='color:black;'>[Error file name: save.php; Error line no: 41]</div>";
                                      break;
                                  case 3:
                                      echo "<div style='color:black;'>[Error file name: save.php; Error line no: 44]</div>";
                                      break;
                                  case 4:
                                      echo "<div style='color:black;'>[Error file name: save.php; Error line no: 51]</div>";
                                      break;
                                  case 5:
                                      echo "<div style='color:black;'>[Error file name: save.php; Error line no: 75]</div>";
                                      break;
                                  case 6:
                                      echo "<div style='color:black;'>[Error file name: scan_qr.php; Error line no: 10]</div>";
                                      break;
                                  case 7:case 8: case 9: case 10:
                                      echo "<div style='color:black;'>[Error file name: scan_qr.php; Error line no: 11]</div>";
                                      break;
                                  case 11:
                                      echo "<div style='color:black;'>[Error file name: save_eval.php; Error line no: 23]</div>";
                                      break;
                                  default:
                                      echo "<div style='color:black;'>[Error file name: unknown; Error line no: unknown]</div>";
                                    break;
                                }
                            ?>
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

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
