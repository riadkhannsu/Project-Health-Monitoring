<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Auth-Token, Origin");
 
// database connection will be here

// files needed to connect to database
include_once 'config/database.php';
include_once 'handler_doctors.php';



// get database connection
$database = new Database();
$db = $database->getConnection();


$data = json_decode(file_get_contents("php://input"), true);

if($data['method'] == null){
	http_response_code(400);
	echo json_encode("error processing");

}else if($data['method'] == "getAllAssigned"){
	
	//METHOD 01
	$response = getAllAssigned($db);
	// set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode($response, JSON_PRETTY_PRINT);

}else if($data['method'] == "getAll"){

	//METHOD 02
	$response = getAll($db);
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode($response, JSON_PRETTY_PRINT);
	
}else if($data['method'] == "getDocById"){

	if(!empty($data['id'])) {
		//METHOD 02
		$response = getDocById($db, $data['id']);
	    // set response code
	    http_response_code(200);
	 
	    // display message: user was created
	    echo json_encode($response, JSON_PRETTY_PRINT);
	}else {
		// set response code
	    http_response_code(400);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "Doctor id not provided"));
	}
	
}