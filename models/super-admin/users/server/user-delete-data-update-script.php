<?php

    include '../../../../config/sessions.php';
    include '../../../../config/constants.php';

    if(isset($_POST["user_id"])){

        $user_id = SanitizeInput(filter_input(INPUT_POST, "user_id"), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // database connection
        require('../../../../db/DataBaseClass.php');

        // Users Class
        require("../../../../controllers/UsersClass.php");

        $UserAccountDeleteObject = new Users;

        $user_account_delete_update = $UserAccountDeleteObject->UserAccountDelete($user_id);

        $data = json_decode($user_account_delete_update, TRUE);

        echo json_encode($data);
    }
