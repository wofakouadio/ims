<?php

    include '../../sessions.php';
    include '../../constants.php';

    if(isset($_POST["user_type"]) && isset($_POST["user_id"])){

        $user_id = SanitizeInput(filter_input(INPUT_POST, "user_id"), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_type = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_type", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));

        // validation check
        if($user_type == "-1"){
            $data = [
                'status' => 'failed',
                'msg' => 'Account Type is required',
                'error' => null,
            ];
        }
        else{

            // database connection
            require('../../../db/db-config.php');

            // Users Class
            require("../../../models/server/super-admin/UsersClass.php");

            $UserAccountTypeObject = new Users;

            $user_account_type_update = $UserAccountTypeObject->UserAccountType($user_id, $user_type);

            $data = json_decode($user_account_type_update, TRUE);

        }

        echo json_encode($data);

    }