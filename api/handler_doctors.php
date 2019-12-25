<?php

// files needed to connect to database
include_once 'config/database.php';



//method: 01
function getAll($db){
	$table_name = "doctors";

	$query = "SELECT * FROM " . $table_name ;
 
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

function getAllAssigned($db){
    $table_name = "assignments";

	$query = "SELECT DISTINCT doctor_id FROM " . $table_name . "
            WHERE
                doctor_id IS NOT NULL";
 
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

function getDocById($db, $d_id){
    $table_name = "doctors";

    $query = "SELECT * FROM " . $table_name . "
            WHERE
                id = :id";
 
    // prepare the query
    $stmt =$db->prepare($query);
    $stmt->bindParam(':id', $d_id);
    if($stmt->execute()){
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        return $stmt->errorInfo();
    }

    return;
}