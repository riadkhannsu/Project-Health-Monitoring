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
include_once 'objects/doctor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$user = new Doctor($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->firstname = $data->firstname;
$user->lastname = $data->lastname;
$user->phone = $data->phone;
$user->password = $data->password;
$user->type = $data->type;
$user->email = $data->email;
$user->dob = $data->dob;
$user->gender = $data->gender;
$user->location = $data->location;
$user->license = $data->license;
$user->specialty = $data->specialty;
$user->education = $data->education;
$user->practice = $data->practice;
 
// use the create() method here
// create the user
if(
    !empty($user->firstname) &&
    !empty($user->phone) &&
    !empty($user->password) &&
    !empty($user->type) &&
    !empty($user->email) &&
    !empty($user->dob) &&
    !empty($user->gender) &&
    !empty($user->location) &&
    !empty($user->license) &&
    !empty($user->specialty) &&
    !empty($user->education) &&
    !empty($user->practice) &&
    !$user->phoneExists() &&
    $user->create()
){
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
        echo json_encode(array("message" => "Doctor with this phone number already registered"));
    }else {
        echo json_encode(array("message" => "Unable to register doctor."));
        if ($data->firstname == "null")
            echo json_encode(array("message" => "data binding error."));
    }
    
}
?>