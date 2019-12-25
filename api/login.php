<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Auth-Token, Origin");
 
// database connection will be here
// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/doctor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));


// files for jwt will be here
  // generate json web token
  include_once 'config/core.php';
  include_once 'libs/php-jwt-master/src/BeforeValidException.php';
  include_once 'libs/php-jwt-master/src/ExpiredException.php';
  include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
  include_once 'libs/php-jwt-master/src/JWT.php';
  use \Firebase\JWT\JWT;


if($data->type == 1 || $data->type == 3){
  $user = new User($db);
  // instantiate user object

 
  // check email existence here
  // get posted data 
  // set product property values
  $user->phone = $data->phone;
  $phone_exists = $user->phoneExists();



   
  
   
  // generate jwt will be here
  // check if email exists and if password is correct
  if($phone_exists && password_verify($data->password, $user->password)){
   
      $token = array(
         "iss" => $iss,
         "aud" => $aud,
         "iat" => $iat,
         "nbf" => $nbf,
         "data" => array(
             "id" => $user->id,
             "firstname" => $user->firstname,
             "lastname" => $user->lastname,
             "phone" => $user->phone
         )
      );
   
      // set response code
      http_response_code(200);
   
      // generate jwt
      $jwt = JWT::encode($token, $key);
      echo json_encode(
              array(
                  "message" => "Successful login.",
                  "user"=> $user->id,
                  "name"=> $user->firstname,
                  "type"=> $user->type,
                  "jwt" => $jwt
              ), JSON_PRETTY_PRINT
          );
   
  }
   
  // login failed will be here
  // login failed
  else{
   
      // set response code
      http_response_code(401);
   
      // tell the user login failed
      echo json_encode(array("message" => "Login failed."));
  }
}else if ($data->type == 2) {
  $doc = new Doctor($db);
  // instantiate user object

 
  // check email existence here
  // get posted data 
  // set product property values
  $doc->phone = $data->phone;
  $phone_exists = $doc->phoneExists();

   
  // generate jwt will be here
  // check if email exists and if password is correct
  if($phone_exists && password_verify($data->password, $doc->password)){
   
      $token = array(
         "iss" => $iss,
         "aud" => $aud,
         "iat" => $iat,
         "nbf" => $nbf,
         "data" => array(
             "id" => $doc->id,
             "firstname" => $doc->firstname,
             "lastname" => $doc->lastname,
             "phone" => $doc->phone
         )
      );
   
      // set response code
      http_response_code(200);
   
      // generate jwt
      $jwt = JWT::encode($token, $key);
      echo json_encode(
              array(
                  "message" => "Successful login.",
                  "user"=> $doc->id,
                  "name"=> $doc->firstname,
                  "type"=> $doc->type,
                  "jwt" => $jwt
              ), JSON_PRETTY_PRINT
          );
   
  }
   
  // login failed will be here
  // login failed
  else{
   
      // set response code
      http_response_code(401);
   
      // tell the user login failed
      echo json_encode(array("message" => "Login failed."));
  }
}

?>