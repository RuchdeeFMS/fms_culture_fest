<?php
class Participant {
    // database connection and table name
    private $conn;
    private $table_name = "participants";

    // object properties
    public $id;
    public $username;

    public $perpage;
    public $start;

    public function __construct($db){
        $this->conn = $db;
    }

    // create information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (id, username) VALUES (?,?)");
        mysqli_stmt_bind_param($stmt, 'ss', $this->id, $this->username);

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
        $query = "UPDATE " . $this->table_name . " SET username = ? WHERE id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $this->username, $this->id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
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

    // find id
    function find_id() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '" . $this->id . "'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>
