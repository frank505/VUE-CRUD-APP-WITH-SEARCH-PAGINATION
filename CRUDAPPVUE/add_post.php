<?php
require_once "config/CORS.php";
CORS::SetHeaders();
 require_once "config/db_config.php";
 require_once "config/CurlHttpHelper.php";
require_once "config/security.php";
 require_once "config/functions.php";
 $request = new CurlHttpHelper();
 $conn = new config();
 $h = getallheaders();
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
        $rename_file = general_functions::RenameFile($file_name);
    $array_data = array("username"=>$username,"email"=>$email,"userage"=>$age,"image"=>$rename_file);
  $insert_query = $conn->insert($table_name,$array_data);
   $run_query = $conn->query($insert_query);
   if($run_query){
   move_uploaded_file($tempoary_name, "user_images/$rename_file");
    $success = array("success"=>"new user added successfully");
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

