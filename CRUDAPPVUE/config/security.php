<?php
class security
{
    
    public static function SanitizeSting($string)
    {
        return filter_var($string,FILTER_SANITIZE_STRING);
    }

    public static function ValidateEmail($email)
    {
        return filter_var($email,FILTER_VALIDATE_EMAIL);
    }

    public static function ImageFile($tempoary_name)
    {
    $mime_type  = array("image/jpeg","image/png", "image/jpg");
   $file_mime_type = mime_content_type(strtolower($tempoary_name));
   if(!in_array($file_mime_type,$mime_type))
   {
       return FALSE;
   }else{
       return TRUE;
   }
    }

    public static function validateNumber($number)
    {
        if(!(is_numeric($number)))
        {
            return FALSE;
        }else{
            return TRUE;
        }

    }

    //end of this class
}