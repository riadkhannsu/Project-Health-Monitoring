<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Auth-Token, Origin");
 
// database connection will be here

// files needed to connect to database
include_once 'config/database.php';
include_once 'handler_sessions.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));

if($data->method == "getAll"){
	if(!empty($data->p_id)){
		$response = getAll($db,$data->p_id);
		// set response code
	    http_response_code(200);
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else {
		http_response_code(400);
		echo json_encode(array("message" => "invalid parameters"));
	}
		

}else if($data->method == "getSingle"){

	if(!empty($data->s_id)){
		$response = getSingle($db, $data->s_id);
	    // set response code
	    http_response_code(200);
	 
	    // display message: user was created
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else {
		http_response_code(400);
		echo json_encode(array("message" => "invalid parameters"));
	}


}