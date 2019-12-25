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
include_once 'handler_update_assign.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));


if($data->method == "assignToTable"){
	if(!empty($data->p_id)){
		if(assignToTable($db, $data->p_id)){
			// set response code
		    http_response_code(200);
		 
		    // display message: unable to create user
		    echo json_encode(array("message" => "patient assigned to table"));
		}else {
			// set response code
		    http_response_code(400);
		 
		    // display message: unable to create user
		    echo json_encode(array("message" => "unable to assign patient to table"));
		}		
	}else {
		// set response code
	    http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "no patient id provided"));
	}
	
}else if($data->method == "assignDoctor"){

	if(
		!empty($data->p_id) &&
		!empty($data->d_id)
	){
		if(assignDoctor($db, $data->p_id, $data->d_id)){
			// set response code
		    http_response_code(200);
		 
		    // display message: unable to create user
		    echo json_encode(array("message" => "doctor assigned to patient"));
		}else {
			// set response code
		    http_response_code(400);
		 
		    // display message: unable to create user
		    echo json_encode(array("message" => "unable to assign doctor to patient"));
		}		
	}else {
		// set response code
	    http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "not all parameters provided"));
	}
	
}