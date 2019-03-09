<?php
require_once "config/CORS.php";
CORS::SetHeaders();
 require_once "config/db_config.php";
require_once "config/security.php";
 require_once "config/functions.php";

 $conn = new config();
 $functions = new general_functions();
 $h = getallheaders();
 //print json_encode($h);
 @$id = htmlspecialchars($_GET["id"]);
 @$authorization = $h["Authorization"];
 if($authorization==CORS::API_KEY){ 
     $table = "userdetails";
     $image_path = $functions->base_url_without_other_route()."/user_images"."/";
        $select_content = "SELECT * FROM $table where id='$id'";
    $run_query = $conn->query($select_content);
    $row_count = $conn->rowcount($run_query);
     if($row_count==0){
        $data = array("error"=>"user with this id doesnt exist");
        print json_encode($data);
        return;
     }
        foreach ($run_query as $key => $results) {
            @$array_value[] = $results; 
         }
              
        $data = array("data"=>$array_value,"user_Image_path"=>$image_path);
        print json_encode($data);
        return;
  }else{
     $error = array("error"=>"401 error unauthorized user");
     print json_encode($error);
     return;
  }