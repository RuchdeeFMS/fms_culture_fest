<?php
class Evaluation {
    // database connection and table name
    private $conn;
    private $table_name = "evaluation";

    // object properties
    public $id;
    public $q1_1;
    public $q1_1_major;
    public $q1_2;
    public $q2_1;
    public $q2_2;
    public $q2_3;
    public $q2_4;
    public $q2_5;
    public $q2_6;
    public $q2_7;
    public $q2_8;
    public $q3;
    public $eval_ts;

    public function __construct($db){
        $this->conn = $db;
    }

    // create information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (id, q1_1, q1_1_major, q1_2, q2_1, q2_2, q2_3, q2_4, q2_5, q2_6, q2_7, q2_8, q3, eval_ts) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, 'ssssssssssssss', $this->id, $this->q1_1, $this->q1_1_major, $this->q1_2, $this->q2_1, $this->q2_2, $this->q2_3, $this->q2_4, $this->q2_5, $this->q2_6, $this->q2_7, $this->q2_8, $this->q3, $this->eval_ts);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  // function create()


}

?>
