<?php

    include '../../sessions.php';
    include '../../constants.php';

    if(isset($_POST["user_status"]) && isset($_POST["user_id"])){

        $user_id = SanitizeInput(filter_input(INPUT_POST, "user_id"), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_status = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_status", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));

        // validation check
        if($user_status == "-1"){
            $data = [
                'status' => 'failed',
                'msg' => 'Account Status is required',
                'error' => null,
            ];
        }
        else{

            // database connection
            require('../../../db/db-config.php');

            // Users Class
            require("../../../models/server/super-admin/UsersClass.php");

            $UserAccountStatusObject = new Users;

            $user_account_status_update = $UserAccountStatusObject->UserAccountStatus($user_status, $user_id);
            // $user_account_status_update = $UserAccountStatusObject->UserAccountPassword($user_id);

            $data = json_decode($user_account_status_update, TRUE);

        }

        echo json_encode($data);

    }