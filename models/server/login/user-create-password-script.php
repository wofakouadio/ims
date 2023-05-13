<?php
    // start session
    session_start();

    // include Sanitize function
    require("../../../config/constants.php");

    if(isset($_POST["u-name"]) && isset($_POST["u-npass"]) && isset($_POST["u-cpass"])){

        $user_name = SanitizeInput(filter_input(INPUT_POST, "u-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $user_npass = SanitizeInput(filter_input(INPUT_POST, "u-npass", FILTER_SANITIZE_SPECIAL_CHARS));
        $user_cpass = SanitizeInput(filter_input(INPUT_POST, "u-cpass", FILTER_SANITIZE_SPECIAL_CHARS));

        $data = [];

        // validation check
        if(empty($user_name)){

            $data = [
                'status' => 'failed',
                'msg' => 'Username is required',
                'error' => null
            ];

        }elseif(empty($user_npass)){

            $data = [
                'status' => 'failed',
                'msg' => 'Password is required',
                'error' => null
            ];

        }elseif(!ValidatePasswordUppercase($user_npass) || !ValidatePasswordLowercase($user_npass) || !ValidatePasswordDigit($user_npass) || !ValidatePasswordDigit($user_npass) || !ValidatePasswordLength($user_npass)){

            $data = [
                'status' => 'failed',
                'msg' => 'Password must follow the requirement below <i class="ti-arrow-down"></i>',
                'error' => null
            ];

        }elseif(empty($user_cpass)){

            $data = [
                'status' => 'failed',
                'msg' => 'Confirm Password is required',
                'error' => null
            ];

        }elseif($user_cpass != $user_npass){

            $data = [
                'status' => 'failed',
                'msg' => 'Passwords do not match',
                'error' => null
            ];

        }else{

            // include db & login classes
            require("../../../db/DataBaseClass.php");
            require("../../../controllers/LoginClass.php");

            // instantiate login class
            $UserPasswordCreation = new LOGIN;

            $data = $UserPasswordCreation->UserPasswordCreation($user_name, $user_npass);

            $data = json_decode($data, TRUE);

        }

        echo json_encode($data);

    }