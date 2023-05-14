<?php
    // require db parameters
    require '../../../../db/db-parameters.php';

    // set variables in new var
$sql_details = array(
    'host' => HOSTNAME,
    'user' => USERNAME,
    'pass' => PASSWORD,
    'db' => DATABASE
);

// DB table to use
$table = 'users';

// primary key of the table
$primary_key = 'user_id';

// get all columns to display
$columns = array(
    array(
        'db' => 'user_fullname',
        'dt' => 0,
        'field' => 'user_fullname'
    ),
    array(
        'db' => 'user_dob',
        'dt' => 1,
        'formatter' => function($d){
            return date("Y") - date("Y", strtotime($d));
        },
        'field' => 'user_dob'
    ),
    array(
        'db' => 'user_gender',
        'dt' => 2,
        'field' => 'user_gender'
    ),
    array(
        'db' => 'user_mobile',
        'dt' => 3,
        'field' => 'user_mobile'
    ),
    array(
        'db' => 'user_mail',
        'dt' => 4,
        'field' => 'user_mail'
    ),
    array(
        'db' => 'user_type',
        'dt' => 5,
        'field' => 'user_type'
    )
);

    require '../../../ssp.class.php';

$joinQuery = 'FROM `users`';

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primary_key, $columns, $joinQuery)
);