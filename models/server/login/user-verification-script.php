<?php
    // start session
    session_start();

    // include Sanitize function
    require("../../../config/constants.php");

    if(isset($_POST["user-name"])){

        $user_name = SanitizeInput(filter_input(INPUT_POST, "user-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $data = [];

        // validation check
        if(empty($user_name)){

            $data = [
                'status' => 'failed',
                'msg' => 'Username is required',
                'error' => null
            ];

        }else{

            // include db & login classes
            require("../../../db/DataBaseClass.php");
            require("../../../controllers/LoginClass.php");

            // instantiate login class
            $UserVerification = new LOGIN;

            $data = $UserVerification->UserVerification($user_name);

            $data = json_decode($data, TRUE);

        }

        echo json_encode($data);

    }