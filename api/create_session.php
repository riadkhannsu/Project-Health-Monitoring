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
include_once 'objects/session.php';

$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$session = new Session($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$session->patient_id = $data->p_id;

if(
    !empty($session->p_id) &&
    $session->create()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "Session was created.",
							"session_id" => $session->id));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create user"));
}
?>