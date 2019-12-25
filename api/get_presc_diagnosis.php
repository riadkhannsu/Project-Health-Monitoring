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
include_once 'handler_presc_diagnosis.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));

if($data->method == "getSinglePresc") {
	if (
		!empty($data->presc_id)
	) {
		
		$response = getSinglePresc($db, $data->presc_id);
		// set response code
	    http_response_code(200);
	 
	    
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else
	{
		http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}
	

}else if($data->method == "getAllPresc"){
	if (
		!empty($data->p_id)
	) {
		
		$response = getAllPresc($db, $data->p_id);
		// set response code
	    http_response_code(200);
	 
	    
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else
	{
		http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}


}else if ($data->method == "getSingleDiagnosis") {
	if (
		!empty($data->diagnosis_id)
	) {
		
		$response = getSingleDiagnosis($db, $data->diagnosis_id);
		// set response code
	    http_response_code(200);
	 
	    
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else
	{
		http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}



}else if($data->method == "getAllDiagnosis"){
	if (
		!empty($data->p_id)
	) {
		//METHOD 01
		$response = getAllDiagnosis($db, $data->p_id);
		// set response code
	    http_response_code(200);
	 
	    
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else
	{
		http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}


}else if($data->method == "createDiagnosis"){
	if (
		!empty($data->p_id) &&
		!empty($data->d_id) &&
		!empty($data->details)
	) {
		//METHOD 01
		$response = createDiagnosis($db, $data->p_id, $data->d_id, $data->details);
		// set response code
	    http_response_code(200);
	 
	    
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else
	{
		http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "invalid parameters"));
	}


}else if($data->method == "createPrescription"){
	if (
		!empty($data->p_id) &&
		!empty($data->d_id) &&
		!empty($data->details)
	) {
		//METHOD 01
		$response = createPrescription($db, $data->p_id, $data->d_id, $data->details);
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