<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Auth-Token, Origin");
 
// database connection will be here

// files needed to connect to database
include_once 'config/database.php';
include_once 'handler_presc_diagnosis.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));

if($data->method == "createPrescription") {
	if(
		!empty($data->p_id) &&
		!empty($data->d_id) &&
		!empty($data->details) 
	){
		if(createPrescription($db, $data->p_id, $data->d_id, $data->details)){
			http_response_code(200);
			 
		    // display message: unable to create user
		    echo json_encode(array("message" => "prescription created"));
		}else {
			http_response_code(400);
			 
		    // display message: unable to create user
		    echo json_encode(array("message" => "prescription could not be created"));
		}

	}else {
		http_response_code(400);
			 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}
}else if ($data->method == "createDiagnosis") {
	if(
		!empty($data->p_id) &&
		!empty($data->d_id) &&
		!empty($data->details) 
	){
		if(createDiagnosis($db, $data->p_id, $data->d_id, $data->details)){
			http_response_code(200);
			 
		    // display message: unable to create user
		    echo json_encode(array("message" => "Diagnosis created"));
		}else {
			http_response_code(400);
			 
		    // display message: unable to create user
		    echo json_encode(array("message" => "Diagnosis could not be created"));
		}

	}else {
		http_response_code(400);
			 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}
} else {
	http_response_code(400);
			 
    // display message: unable to create user
    echo json_encode(array("message" => "invalid parameters"));
}

