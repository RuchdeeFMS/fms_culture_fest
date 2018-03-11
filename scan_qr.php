<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Scan QR Code</title>
  </head>
  <script>
    function getLocation() {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition, showError);
      } else {
          // Geolocation is not supported by this browser
          window.location.href = "error.php?error_no=6";
      }
    }

    function showPosition(position) {
        // update zone, latitude, and longitude
        window.location.href = "save.php?zone=" + <?php echo $_REQUEST["zone"]; ?> + "&clat=" + position.coords.latitude + "&clong=" + position.coords.longitude;
    }

    function showError(error) {
      switch(error.code) {
         case error.PERMISSION_DENIED:
             // User denied the request for Geolocation
             window.location.href = "error.php?error_no=7";
             break;
         case error.POSITION_UNAVAILABLE:
             // Location information is unavailable
             window.location.href = "error.php?error_no=8";
             break;
         case error.TIMEOUT:
             // The request to get user location timed out
             window.location.href = "error.php?error_no=9";
             break;
         case error.UNKNOWN_ERROR:
             // An unknown error occurred
             window.location.href = "error.php?error_no=10";
             break;
        }
    }
  </script>
  <body onload="getLocation()">
  </body>
</html>
