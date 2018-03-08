<?php
class Participant_Zone {
    // database connection and table name
    private $conn;
    private $table_name = "participants_zones";

    // object properties
    public $id;
    public $zone;
    public $latitude;
    public $longitude;
    public $cdate;

    public $perpage;
    public $start;

    private $zone_status = 1;

    public function __construct($db){
        $this->conn = $db;
    }

    // create information
    function create(){
        switch ($this->zone) {
          case 1:
              $query = "INSERT INTO " . $this->table_name . " (id, zone_1, zone_1_ts, zone_1_lat, zone_1_long) VALUES (?,?,?,?,?)";
              break;
          case 2:
              $query = "INSERT INTO " . $this->table_name . " (id, zone_2, zone_2_ts, zone_2_lat, zone_2_long) VALUES (?,?,?,?,?)";
              //$query = "INSERT INTO " . $this->table_name . " (id, zone_2) VALUES (?,?)";
              break;
          case 3:
              $query = "INSERT INTO " . $this->table_name . " (id, zone_3, zone_3_ts, zone_3_lat, zone_3_long) VALUES (?,?,?,?,?)";
              break;
          case 4:
              $query = "INSERT INTO " . $this->table_name . " (id, zone_4, zone_4_ts, zone_4_lat, zone_4_long) VALUES (?,?,?,?,?)";
              break;
          case 5:
              $query = "INSERT INTO " . $this->table_name . " (id, zone_5, zone_5_ts, zone_5_lat, zone_5_long) VALUES (?,?,?,?,?)";
              break;
          case 6:
              $query = "INSERT INTO " . $this->table_name . " (id, zone_6, zone_6_ts, zone_6_lat, zone_6_long) VALUES (?,?,?,?,?)";
              break;
          case 7:
              $query = "INSERT INTO " . $this->table_name . " (id, zone_7, zone_7_ts, zone_7_lat, zone_7_long) VALUES (?,?,?,?,?)";
              break;
          case 8:
              $query = "INSERT INTO " . $this->table_name . " (id, zone_8, zone_8_ts, zone_8_lat, zone_8_long) VALUES (?,?,?,?,?)";
              break;
          case 9:
              $query = "INSERT INTO " . $this->table_name . " (id, zone_9, zone_9_ts, zone_9_lat, zone_9_long) VALUES (?,?,?,?,?)";
              break;
        }
        // write statement
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssss', $this->id, $this->zone_status, $this->cdate, $this->latitude, $this->longitude);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }else {
            return false;
        }
    }  // function create()

    // read all records
    function readall(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id LIMIT " . $this->start . ", " . $this->perpage;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '" . $this->id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // update record - account
    function update(){
        switch ($this->zone) {
          case 1:
            $query = "UPDATE " . $this->table_name . " SET zone_1 = ?, zone_1_ts = ?, zone_1_lat = ?, zone_1_long = ? WHERE id = ?";
            break;
          case 2:
            $query = "UPDATE " . $this->table_name . " SET zone_2 = ?, zone_2_ts = ?, zone_2_lat = ?, zone_2_long = ? WHERE id = ?";
            break;
          case 3:
            $query = "UPDATE " . $this->table_name . " SET zone_3 = ?, zone_3_ts = ?, zone_3_lat = ?, zone_3_long = ? WHERE id = ?";
            break;
          case 4:
            $query = "UPDATE " . $this->table_name . " SET zone_4 = ?, zone_4_ts = ?, zone_4_lat = ?, zone_4_long = ? WHERE id = ?";
            break;
          case 5:
            $query = "UPDATE " . $this->table_name . " SET zone_5 = ?, zone_5_ts = ?, zone_5_lat = ?, zone_5_long = ? WHERE id = ?";
            break;
          case 6:
            $query = "UPDATE " . $this->table_name . " SET zone_6 = ?, zone_6_ts = ?, zone_6_lat = ?, zone_6_long = ? WHERE id = ?";
            break;
          case 7:
            $query = "UPDATE " . $this->table_name . " SET zone_7 = ?, zone_7_ts = ?, zone_7_lat = ?, zone_7_long = ? WHERE id = ?";
            break;
          case 8:
            $query = "UPDATE " . $this->table_name . " SET zone_8 = ?, zone_8_ts = ?, zone_8_lat = ?, zone_8_long = ? WHERE id = ?";
            break;
          case 9:
            $query = "UPDATE " . $this->table_name . " SET zone_9 = ?, zone_9_ts = ?, zone_9_lat = ?, zone_9_long = ? WHERE id = ?";
            break;
        }

        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->zone_status, $this->cdate, $this->latitude, $this->longitude, $this->id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            // check and update all_zones
            if ($this->update_all_zones()) {
                return true;
            } else {
                return false;
            }
        }else {
            return false;
        }
    }

    // delete record
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }else {
            return false;
        }
    }

    // update all_zones
    function update_all_zones() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '" . $this->id . "' and zone_2 = 1 and zone_3 = 1 and zone_4 = 1 and zone_5 = 1 and zone_6 = 1";
        $result = mysqli_query($this->conn, $query);
        if ($row = mysqli_fetch_array($result)) {
            // update all_zones
            $query = "UPDATE " . $this->table_name . " SET all_zones = ? WHERE id = ?";
            // statement
            $stmt = mysqli_prepare($this->conn, $query);
            // bind parameters
            mysqli_stmt_bind_param($stmt, 'ss', $this->$zone_status, $this->id);
            /* execute prepared statement */
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }   // end update all_zones

    // scanned qr code alredy?
    function isScanned() {
        switch ($this->zone) {
          case 1:
              $query = "SELECT * FROM ". $this->table_name . " WHERE id = '" . $this->id . "' and zone_1 = 1";
              break;
          case 2:
              $query = "SELECT * FROM ". $this->table_name . " WHERE id = '" . $this->id . "' and zone_2 = 1";
              break;
          case 3:
              $query = "SELECT * FROM ". $this->table_name . " WHERE id = '" . $this->id . "' and zone_3 = 1";
              break;
          case 4:
              $query = "SELECT * FROM ". $this->table_name . " WHERE id = '" . $this->id . "' and zone_4 = 1";
              break;
          case 5:
              $query = "SELECT * FROM ". $this->table_name . " WHERE id = '" . $this->id . "' and zone_5 = 1";
              break;
          case 6:
              $query = "SELECT * FROM ". $this->table_name . " WHERE id = '" . $this->id . "' and zone_6 = 1";
              break;
          case 7:
              $query = "SELECT * FROM ". $this->table_name . " WHERE id = '" . $this->id . "' and zone_7 = 1";
              break;
          case 8:
              $query = "SELECT * FROM ". $this->table_name . " WHERE id = '" . $this->id . "' and zone_8 = 1";
              break;
          case 9:
              $query = "UPDATE " . $this->table_name . " SET zone_9 = ?, zone_9_ts = ?, zone_9_lat = ?, zone_9_long = ? WHERE id = ?";
              break;
        }
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>
