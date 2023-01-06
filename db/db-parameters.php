<?php

    // define global variables for db connection/configuration
    // root url for the system
    define("ROOT_URL", "http://localhost/ims/");

    // DB parameters
    // hostname
    define("HOSTNAME", "localhost");
    // username
    define("USERNAME","root");
    // password
    define("PASSWORD","root");
    // DB
    define("DATABASE", "ims-project");
    // charset
    define("CHARSET", "utf8");
    // data source name [DSN]
    define("DNS", "mysql:host=".HOSTNAME.";dbname=".DATABASE.";charset=".CHARSET."");