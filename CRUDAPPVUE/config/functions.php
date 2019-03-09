<?php
class general_functions
{
    public static function RenameFile($file_name)
    {
        $explode_file = explode(".", $file_name);
        $newfilename = round(microtime(true)) . '.' . end($explode_file);
        return $newfilename;
    }
    public function base_url()
    {
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public function base_url_without_other_route()
    {
        $url = "http://localhost/CRUDAPPVUE";
        return $url;
    }
    
}