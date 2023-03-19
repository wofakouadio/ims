<?php

    include '../../sessions.php';
    include '../../constants.php';

    if(isset($_POST["user_id"])){

        $user_id = SanitizeInput(filter_input(INPUT_POST, "user_id"), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // database connection
        require('../../../db/db-config.php');

        // Users Class
        require("../../../models/server/super-admin/UsersClass.php");

        $UserAccountResetObject = new Users;

        $user_account_reset_update = $UserAccountResetObject->UserAccountPassword($user_id);

        $data = json_decode($user_account_reset_update, TRUE);

        echo json_encode($data);
    }
