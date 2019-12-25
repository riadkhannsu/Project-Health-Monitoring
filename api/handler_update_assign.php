<?php

// files needed to connect to database
include_once 'config/database.php';

//method: 06
function assignToTable($db, $pid){
    $table_name = "assignments";

    $query = "INSERT INTO " . $table_name . "
            SET
                patient_id = :p_id";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':p_id', $pid);


    if($stmt->execute()){
        return true;
    }else
    {
        print_r($stmt->errorInfo());
    }

    return false;
}

//method: 01
function assignDoctor($db, $pid, $did){
    $table_name = "assignments";

    $query = "UPDATE " . $table_name . "
            SET
                doctor_id = :did
                WHERE
                patient_id = :pid";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':pid', $pid);
    $stmt->bindParam(':did', $did);

    
    if($stmt->execute()){
        return true;
    }else
    {
        print_r($stmt->errorInfo());
    }

    return false;
}


