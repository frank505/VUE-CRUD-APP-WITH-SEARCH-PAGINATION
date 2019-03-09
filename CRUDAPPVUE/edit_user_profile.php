<?php
//update($array_data,$table_name,$where_clause)
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
    @$username = security::SanitizeSting($_POST["username"]);
    @$email = security::ValidateEmail($_POST["email"]);
    @$age = $_POST["userage"];
    @$file_name = $_FILES["file"]["name"];
    @$tempoary_name = $_FILES["file"]["tmp_name"];
    @$file_size = $_FILES["file"]["size"];
     @$id = $_POST["id"];
    if($username==""){
        $error = array("error"=>"username field cannot be left empty");
        print json_encode($error);
    }
   else if($email==""){
        $error = array("error"=>"invalid or empty email entered ");
        print json_encode($error);
    }else if($age==""){
        $error = array("error"=>"age field cannot be left empty");
        print json_encode($error);
    
    }
    else if($file_name==""){
        $error = array("error"=>"file name cannot be left empty");
        print json_encode($error);
    }
    
    else{
        $validate_file = security::ImageFile($tempoary_name);
        @$age_check = security::validateNumber($_POST["userage"]);
        if($validate_file==FALSE){
            $error = array("error"=>"this is not an image file");
            print json_encode($error);
        }else if($age_check!=1){
            $error = array("error"=>"only numbers are accepted");
            print json_encode($error);
        }
        
        else{
        $table_name = "userdetails";
        $user_image_to_delete ="";
        $select_data = "SELECT * FROM $table_name where id='$id'";
        $run_this = $conn->query($select_data);
        foreach ($run_this as $key => $values) {
           @$user_image_to_delete = $values["image"];
        }
  unlink("./user_images/".$user_image_to_delete);
        $rename_file = general_functions::RenameFile($file_name);
    $array_data = array("username"=>"$username","email"=>"$email",
    "userage"=>"$age","image"=>"$rename_file");
    $where_clause ="id='$id'";
  $update_query = $conn->update($table_name,$array_data,$where_clause);
   $run_query = $conn->query($update_query);
   //var_dump($run_query);
  // return;
   if($run_query){
   move_uploaded_file($tempoary_name, "user_images/$rename_file");
    $success = array("success"=>"user profile updated successfully");
    print json_encode($success);
   }else{
    $error = array("error"=>"there seems to be a problem here");
    print json_encode($error);
   }
        }
    
        }
    

}else{
    $error = array("error"=>"401 error unauthorized user");
    print json_encode($error);
}

