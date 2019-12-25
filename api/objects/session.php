<?php
// 'user' object
class Session{
 
    // database connection and table name
    private $conn;
    private $table_name = "session";
 
    // object properties
    public $id;
    public $patient_id;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
// create() method will be here

// create new user record
function create(){
 
    // insert query
    $query = "INSERT INTO " . $this->table_name . "
            SET
                patient_id = :patient_id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // bind the values
    $stmt->bindParam(':patient_id', $this->patient_id);

    // execute the query, also check if query was successful
    if($stmt->execute()){
        $this->id = $this->conn->lastInsertId();
        return true;
    }else
    {
        print_r($stmt->errorInfo());
    }

    return false;
}
 
}