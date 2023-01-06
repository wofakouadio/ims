<?php

    // script to destroy session and its variables

    // session start
    session_start();

    // unset any variable
    unset($variable);
    unset($variable);
    unset($variable);

    // destroy session
    session_destroy();

    // redirect  to default page
    header("location:../login/user-verification");

    // exit
    exit();