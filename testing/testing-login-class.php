<?php
    require '../db/DataBaseClass.php';
    require '../controllers/LoginClass.php';

    // $UserObject = new LOGIN($user_name, $user_password, $user_id, $user_fullname, $user_type, $user_status, $user_loginBefore);
    $UserObject = new LOGIN;

    $user_name = "wofakouadio";

    echo $UserObject->UserVerification($user_name);
