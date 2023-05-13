<?php
    // start session
    session_start();

    // include Sanitize function
    require("../../../config/constants.php");

    if(isset($_POST["u-name"]) && isset($_POST["u-pass"])){

        $user_name = SanitizeInput(filter_input(INPUT_POST, "u-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $user_password = SanitizeInput(filter_input(INPUT_POST, "u-pass", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $data = [];

        // validation check
        if(empty($user_password)){

            $data = [
                'status' => 'failed',
                'msg' => 'Password is required',
                'error' => null
            ];

        }else{

            // include db & login classes
            require("../../../db/DataBaseClass.php");
            require("../../../controllers/LoginClass.php");

            // instantiate login class
            $UserLogin = new LOGIN;

            $data = $UserLogin->UserLogin($user_name, $user_password);

            $data = json_decode($data, TRUE);

        }

        echo json_encode($data);

    }