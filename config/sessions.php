<?php

    // start session
    session_start();

    $user_fullname = '';
    $user_name = '';
    $user_type = '';
    $user_id = '';

    if(!isset($_SESSION["user_fullname"]) && !isset($_SESSION["user_name"]) && !isset($_SESSION["user_id"]) && !isset($_SESSION["user_type"])){

        header("location:../");

        exit();

    }else{

        $user_fullname = $_SESSION["user_fullname"];
        $user_name = $_SESSION["user_name"];
        $user_type = $_SESSION["user_type"];
        $user_id = $_SESSION["user_id"];

    }