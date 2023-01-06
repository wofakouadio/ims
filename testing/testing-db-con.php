<?php
    require '../db/db-config.php';

    $test_db_con = new DBCon;

    echo $test_db_con->connectionString();