<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Auth-Token, Origin");
 
// database connection will be here

// files needed to connect to database
include_once 'config/database.php';
include_once 'handler_patients.php';



// get database connection
$database = new Database();
$db = $database->getConnection();


//tonne of useless comments to force update the server cache and reload scripts 
//tonne of useless comments to force update the server cache and reload scripts 
//tonne of useless comments to force update the server cache and reload scripts 
//tonne of useless comments to force update the server cache and reload scripts 
//tonne of useless comments to force update the server cache and reload scripts 
//tonne of useless comments to force update the server cache and reload scripts 
//tonne of useless comments to force update the server cache and reload scripts 
//tonne of useless comments to force update the server cache and reload scripts 
//tonne of useless comments to force update the server cache and reload scripts 
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"), true);
//print_r($data['d_id']);
//print_r($data['method']);
//var_dump($data);


if($data['req'] == null){
	http_response_code(400);
	echo json_encode("error processing");

}else if($data['req'] == "getAll"){
	
	//METHOD 01
	$response = getAllPatients($db);
	// set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode($response, JSON_PRETTY_PRINT);

}else if($data['req'] == "getAllUnassigned"){

	//METHOD 02
	$response = getAllUnassignedPatients($db);
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode($response, JSON_PRETTY_PRINT);
	
}else if($data['req'] == "getAllMy"){

	//METHOD 03
	if(!empty($data['d_id'])){
	 	$response = getAllMyPatients($db, $data['d_id']);
	    // set response code
	    http_response_code(200);
	 
	    // display message: user was created
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}
	 
	// message if unable to create user
	else{
	 
	    // set response code
	    http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "Unable to get patient list"));
	}

}else if($data['req'] == "getAllAssigned"){
	
	//METHOD 04
	$response = getAllAssignedPatients($db);
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode($response, JSON_PRETTY_PRINT);

}else if($data['req'] == "getIndividual"){
	
	//METHOD 05
	if(!empty($data['p_id'])){
	 	$response = getIndividualPatient($db, $data['p_id']);
	    // set response code
	    http_response_code(200);
	 
	    // display message: user was created
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}
	 
	// message if unable to create user
	else{
	 
	    // set response code
	    http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "Unable to get patient details"));
	}

}else if($data['req'] == "getPatientByPhone"){
	
	//METHOD 05
	if(!empty($data['phone'])){
	 	$response = getPatientByPhone($db, $data['phone']);
	    // set response code
	    http_response_code(200);
	 
	   
    	// display message: user was created
    	echo json_encode($response, JSON_PRETTY_PRINT);
	    
	}
	 
	// message if unable to create user
	else{
	 
	    // set response code
	    http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "Unable to get patient details"));
	}

}else {
	// set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Bad request"));
}