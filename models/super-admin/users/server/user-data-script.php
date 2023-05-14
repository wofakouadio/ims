<?php

    include '../../../../config/sessions.php';
    include '../../../../config/constants.php';

    if(isset($_GET["user_id"])){

        $user_id = SanitizeInput(strtoupper(filter_input(INPUT_GET, "user_id", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));

        // database connection
        require('../../../../db/DataBaseClass.php');

        // Users Class
        require("../../../../controllers/UsersClass.php");

        $UserObject = new Users;


        $user_data = $UserObject->FetchUserData($user_id);

        $data = json_decode($user_data, TRUE);

        echo json_encode($data);

    }