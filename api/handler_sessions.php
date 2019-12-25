<?php

// files needed to connect to database
include_once 'config/database.php';


function getAll($db, $p_id){
	$table_name = "session";

	$query = "SELECT id, date_created FROM " . $table_name . "
            WHERE
                patient_id = :p_id";
 
    // prepare the query
    $stmt =$db->prepare($query);

    $stmt->bindParam(':p_id', $p_id);
    if($stmt->execute()){
    	$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        print_r($stmt->errorInfo());
    }

    return;
}




function getSingle($db, $s_id){
	$table_name = "session";

	$query = "SELECT patient_id, date_created FROM " . $table_name . "
            WHERE
                id = :s_id";
 
    // prepare the query
    $stmt =$db->prepare($query);

    $stmt->bindParam(':s_id', $s_id);
    if($stmt->execute()){
    	$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        
    }else
    {
        print_r($stmt->errorInfo());
    }

    return;
}