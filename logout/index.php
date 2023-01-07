<?php

    // script to destroy session and its variables

    // session start
    session_start();

    // unset any variable
    unset($_SESSION["user_fullname"]);
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_type"]);
    unset($_SESSION["user_id"]);

    // destroy session
    session_destroy();

    // redirect  to default page
    header("location:../login/user-verification");

    // exit
    exit();