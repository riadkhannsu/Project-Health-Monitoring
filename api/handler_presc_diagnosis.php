<?php

// files needed to connect to database
include_once 'config/database.php';


//method: 02
function createPrescription($db, $p_id, $d_id, $details){
    $table_name = "prescriptions";

    $query = "INSERT INTO " . $table_name . "
            SET
                patient_id = :p_id,
                doctor_id = :d_id,
                details = :details";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':p_id', $p_id);
    $stmt->bindParam(':d_id', $d_id);
    $stmt->bindParam(':details', $details);


    if($stmt->execute()){
        return true;
    }else
    {
        print_r($stmt->errorInfo());
    }

    return false;

}



function createDiagnosis($db, $p_id, $d_id, $details){
    $table_name = "diagnosis";

    $query = "INSERT INTO " . $table_name . "
            SET
                patient_id = :p_id,
                doctor_id = :d_id,
                details = :details";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':p_id', $p_id);
    $stmt->bindParam(':d_id', $d_id);
    $stmt->bindParam(':details', $details);


    if($stmt->execute()){
        return true;
    }else
    {
        print_r($stmt->errorInfo());
    }

    return false;

}



function getSinglePresc($db, $presc_id){
    $table_name = "prescriptions";

    $query = "SELECT id, patient_id, doctor_id, details, status, created FROM " . $table_name . "
            WHERE
                id = :id";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':id', $presc_id);
    if($stmt->execute()){
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}

function getAllPresc($db, $patient_id){
    $table_name = "prescriptions";

    $query = "SELECT id, doctor_id, details, status, created FROM " . $table_name . "
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


function getSingleDiagnosis($db, $diagnosis_id){
    $table_name = "diagnosis";

    $query = "SELECT patient_id, doctor_id, details, created FROM " . $table_name . "
            WHERE
                id = :diagnosis_id";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':diagnosis_id', $diagnosis_id);
    if($stmt->execute()){
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}

function getAllDiagnosis($db, $patient_id){
    $table_name = "diagnosis";

    $query = "SELECT id, doctor_id, details, created FROM " . $table_name . "
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



