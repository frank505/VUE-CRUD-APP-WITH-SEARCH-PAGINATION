<?php
require_once "config/CORS.php";
CORS::SetHeaders();
require_once "config/db_config.php";
require_once "config/security.php";
require_once "config/functions.php";
$conn = new config();
$functions = new general_functions();
 $h = getallheaders(); //i think this only works on apache but i am sure 
 ///nginx and others should have thiers if you do some little search
 //print json_encode($h);
 $authorization = $h["Authorization"];
// $headers = array("error"=>$authorization);
// print json_encode($headers);
//$this->input->get_request_header('X-Requested-With'); codeigniter note

if($authorization==CORS::API_KEY){ 
    @$id = htmlspecialchars($_POST["id"]);
    if($id==NULL || $id == ""){
   $error = array("error"=>"there seems to be a problem");
   print json_encode($error);
   return;
    }else{
    
        $table = "userdetails";
        $where_clause = "WHERE id='$id'";
        $select = "SELECT * FROM $table $where_clause";
        $run_this = $conn->query($select);
        foreach ($run_this as $key => $value) {
          $user_image = $value["image"];
        }
        $delete_query = $conn->delete($table,$where_clause);
        $run_query = $conn->query($delete_query);
        if($run_query){
            unlink("./user_images/".$user_image);
        $success = array("success"=>"content deleted successfully");  
        print json_encode($success);
          }else{
            $error = array("error"=>"there seems to be a problem content failed to be deleted");
   print json_encode($error);
   return;
        }
    }
}
    else{
    $error = array("error"=>"401 error unauthorized user");
    print json_encode($error);
}

