<?php

    include '../../../sessions.php';
    include '../../../constants.php';

    if(isset($_POST["user_id"])){

        $user_id = SanitizeInput(filter_input(INPUT_POST, "user_id"), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // database connection
        require('../../../../db/db-config.php');

        // Users Class
        require("../../../../models/server/super-admin/users/UsersClass.php");

        $UserAccountDeleteObject = new Users;

        $user_account_delete_update = $UserAccountDeleteObject->UserAccountDelete($user_id);

        $data = json_decode($user_account_delete_update, TRUE);

        echo json_encode($data);
    }
