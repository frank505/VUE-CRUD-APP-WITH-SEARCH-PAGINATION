<?php
require_once "config/CORS.php";
CORS::SetHeaders();
 require_once "config/db_config.php";
 require_once "config/CurlHttpHelper.php";
require_once "config/security.php";
 require_once "config/functions.php";
 require_once "config/pagination.php";
 $request = new CurlHttpHelper();
 $conn = new config();
 $pagination = new Pagination();
 $functions = new general_functions();
 $h = getallheaders();
 //print json_encode($h);
 @$authorization = $h["Authorization"];
 if($authorization==CORS::API_KEY){ 
     $table = "userdetails";
     $other_url = "view";
     $image_path = $functions->base_url_without_other_route()."/user_images"."/";
        $select_content = "SELECT * FROM $table ORDER BY ID DESC";
    $run_query = $conn->query($select_content);
    $row_count = $conn->rowcount($run_query);
   
        foreach ($run_query as $key => $results) {
            @$array_value[] = $results; 
         }
              
       $pagination->totalRecords($select_content);
       $pagination->setLimit(4);
       $pagination->page("page",$array_value,$other_url);
       $user_data = $pagination->fetchResults();
        if($pagination->nextLast()==NULL && $pagination->firstBack()==NULL){
            $pager_links = array("first_back"=>NULL,
            "where"=>NULL,
            "next_last"=>NULL);    
        }else{
        //this is to set pagination links
        $pager_links = array("first_back"=>$pagination->firstBack(),
        "where"=>$pagination->where(),
        "next_last"=>$pagination->nextLast());
        }
       
        $data = array("data"=>$user_data, "links"=>$pager_links,"user_Image_path"=>$image_path);
        print json_encode($data);
  }else{
     $error = array("error"=>"401 error unauthorized user");
     print json_encode($error);
  }