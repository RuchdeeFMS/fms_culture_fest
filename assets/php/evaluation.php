<?php
class Evaluation {
    // database connection and table name
    private $conn;
    private $table_name = "evaluation";

    // object properties
    public $id;
    public $q1_res;

    public function __construct($db){
        $this->conn = $db;
    }

    // create information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (id, q1) VALUES (?,?)");
        mysqli_stmt_bind_param($stmt, 'ss', $this->id, $this->q1_res);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  // function create()


}

?>
