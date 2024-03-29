<?php
    // this file constants holds functions and constants
    // root url for the system
    define("ROOT_URL", "http://localhost/ims/");
    // constant for system name
    define("APP_NAME", "Inventory Management System");
    // constant that generates form path
    define("FORM_PATH", htmlspecialchars($_SERVER["PHP_SELF"]));

    // function to sanitize form data
    function SanitizeInput($data){
        $data = trim($data);
        $data = htmlentities($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);

        return $data;
    }

    // function to check if password contain uppercase characters
    function ValidatePasswordUppercase($data){

        if(!preg_match('@[A-Z]@', $data)) return false;
        else return true;

    }

    // function to check if password contain lowercase characters
    function ValidatePasswordLowercase($data){

        if(!preg_match('@[a-z]@', $data)) return false;
        else return true;

    }


    // function to check if password contain digits
    function ValidatePasswordDigit($data){

        if(!preg_match('@[0-9]@', $data)) return false;
        else return true;

    }

    // function check password length
    function ValidatePasswordLength($data){

        if(strlen($data) < 8) return false;
        else return true;

    }

    // function check password has special characters
    function ValidatePasswordSpecialCharacters($data){

        if(!preg_match('@[^\w]@', $data)) return false;
        else return true;

    }

    // function to compress image
    function ImageCompression($image_source, $image_compress)
    {

        $image_info = getimagesize($image_source);
        if ($image_info["mime"] == "image/jpeg") {
            $image_source = imagecreatefromjpeg($image_source);
            imagejpeg($image_source, $image_compress, 35);
        } elseif ($image_info["mime"] == "image/png") {
            $image_source = imagecreatefrompng($image_source);
            imagepng($image_source, $image_compress, 6);
        } else {
            $image_source = imagecreatefromjpeg($image_source);
            imagejpeg($image_source, $image_compress, 35);
        }

        return $image_compress;
    }