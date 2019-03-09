<?php
class CORS
{
 Const API_KEY = "password";
//set headers and allow for CORS
 public static function SetHeaders()
 {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header("Access-Control-Allow-Methods:PUT, GET, POST, DELETE, OPTIONS");
    header("Content-Type: application/json; charset=UTF-8");    
 }
 
}




