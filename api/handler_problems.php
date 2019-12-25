<?php

// files needed to connect to database
include_once 'config/database.php';


//method: 02
function createProblem($db, $p_id, $details, $severity){
    $table_name = "problems";

    $query = "INSERT INTO " . $table_name . "
            SET
                patient_id = :p_id,
                description = :details,
                severity = :severity";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':p_id', $p_id);
    $stmt->bindParam(':details', $details);
    $stmt->bindParam(':severity', $severity);


    if($stmt->execute()){
        return true;
    }else
    {
        print_r($stmt->errorInfo());
    }

    return false;

}



function getProblem($db, $id){
    $table_name = "problems";

    $query = "SELECT * FROM " . $table_name . "
            WHERE
                id = :id";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':id', $id);
    if($stmt->execute()){
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}

function getAllProblems($db, $patient_id){
    $table_name = "problems";

    $query = "SELECT * FROM " . $table_name . "
            WHERE
                patient_id = :patient_id";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':patient_id', $patient_id);
    if($stmt->execute()){
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}


