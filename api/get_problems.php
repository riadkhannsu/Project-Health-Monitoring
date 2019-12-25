<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Auth-Token, Origin");
 
// database connection will be here

// files needed to connect to database
include_once 'config/database.php';
include_once 'handler_problems.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));

if($data->method == "getProblem") {
	if (
		!empty($data->id)
	) {
		
		$response = getProblem($db, $data->id);
		// set response code
	    http_response_code(200);
	 
	    
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else
	{
		http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}
	

}else if($data->method == "getAllProblems"){
	if (
		!empty($data->p_id)
	) {
		
		$response = getAllProblems($db, $data->p_id);
		// set response code
	    http_response_code(200);
	 
	    
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else
	{
		http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}


}else if($data->method == "createProblem"){
	if (
		!empty($data->p_id) &&
		!empty($data->details) &&
		!empty($data->severity)
	) {
		//METHOD 01
		$response = createProblem($db, $data->p_id, $data->details, $data->severity);
		// set response code
	    http_response_code(200);
	 
	    
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else
	{
		http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}


}