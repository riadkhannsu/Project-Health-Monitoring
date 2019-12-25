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
include_once 'objects/user.php';
include_once 'handler_update_assign.php';
include_once 'handler_patients.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$user = new User($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->firstname = $data->firstname;
$user->lastname = $data->lastname;
$user->phone = $data->phone;
$user->password = $data->password;
$user->type = $data->type;
$user->dob = $data->dob;
$user->gender = $data->gender;
$user->email = $data->email;
$user->location = $data->location;
 
// use the create() method here
// create the user
if(
    !empty($user->firstname) &&
    !empty($user->lastname) &&
    !empty($user->phone) &&
    !empty($user->password) &&
    !empty($user->type) &&
    !empty($user->dob) &&
    !empty($user->gender) &&
    !empty($user->email) &&
    !empty($user->location) &&
    !$user->phoneExists() &&
    $user->create()
){
    $pData = getPatientByPhone($db, $user->phone);
    
    if($user->type == "1")
        assignToTable($db, $pData['id']);
    
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "User was created."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    if($user->phoneExists()){
        echo json_encode(array("message" => "User with this phone number already registered"));
    }else {
        echo json_encode(array("message" => "Unable to create user."));
    }
    
}
?>