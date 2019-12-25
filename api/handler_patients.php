<?php

// files needed to connect to database
include_once 'config/database.php';

//method: 01
function getAllPatients($db){
	$table_name = "users";

	$query = "SELECT * FROM " . $table_name . "
            WHERE
                type = 1";
 
    // prepare the query
    $stmt =$db->prepare($query);

    if($stmt->execute()){
    	$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        print_r($stmt->errorInfo());
    }

    return;
}

//method: 02
function getAllUnassignedPatients($db){
    $table1_name = "assignments";
    $table2_name = "users";

    $query = "SELECT * FROM " . $table1_name . "
            INNER JOIN " .$table2_name. " ON patient_id = users.id   
            WHERE
                doctor_id IS NULL AND users.type = 1";
 
    // prepare the query
    $stmt =$db->prepare($query);

    if($stmt->execute()){
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}

//method: 03
function getAllMyPatients($db, $d_id){
    $table1_name = "assignments";
    $table2_name = "users";

    $query = "SELECT * FROM " . $table1_name . "
            INNER JOIN " .$table2_name. " ON patient_id = users.id   
            WHERE
                doctor_id =:d_id AND users.type = 1";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':d_id', $d_id);
    if($stmt->execute()){
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}

//method: 04
function getAllAssignedPatients($db){
    $table1_name = "assignments";
    $table2_name = "users";

    $query = "SELECT * FROM " . $table1_name . "
            INNER JOIN " .$table2_name. " ON patient_id = users.id
            WHERE
                doctor_id IS NOT NULL AND users.type = 1";
 
    // prepare the query
    $stmt =$db->prepare($query);
    //$stmt->bindParam(':doc_id', $d_id);
    if($stmt->execute()){
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}


//method: 05
function getIndividualPatient($db, $p_id){
    $table_name = "users";

    $query = "SELECT * FROM " . $table_name . "
            WHERE
                id = :id";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':id', $p_id);
    if($stmt->execute()){
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}

function getPatientByPhone($db, $phone){
    $table_name = "users";

    $query = "SELECT * FROM " . $table_name . "
            WHERE
                phone = :phone AND users.type = 1";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':phone', $phone);
    if($stmt->execute()){
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}




