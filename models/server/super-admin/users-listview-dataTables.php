<?php
    // require db parameters
    require '../../../db/db-parameters.php';

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
        'db' => 'user_name',
        'dt' => 1,
        'field' => 'user_name'
    ),
    array(
        'db' => 'user_type',
        'dt' => 2,
        'field' => 'user_type'
    ),
    array(
        'db' => 'user_status',
        'dt' => 3,
        'formatter' => function($d){
            if($d == 1){
                return '<span class="badge text-uppercase bg-success text-white">active</span>';
            }else{
                return '<span class="badge text-uppercase bg-danger text-white">inactive</span>';
            }
        },
        'field' => 'user_status'
    ),
    array(
        'db' => 'user_loginBefore',
        'dt' => 4,
        'formatter' => function($d){
            if($d == 1){
                return '<span class="badge text-uppercase bg-success text-white">yes</span>';
            }else{
                return '<span class="badge text-uppercase bg-danger text-white">no</span>';
            }
        },
        'field' => 'user_loginBefore'
    ),
    array(
        'db' => 'user_id',
        'dt' => 5,
        'formatter' => function($d, $row){
            if($row["user_type"] != "SUPER-ADMIN"){
                return '
                    <button class="btn btn-sm btn-primary text-white"><i class="mdi mdi-account" data-toggle="modal" data-target="#UserAccountType" data-user_id="'.$d.'"></i></button>
                    <button class="btn btn-sm btn-info text-white"><i class="mdi mdi-settings" data-toggle="modal" data-target="#UserAccountStatus" data-user_id="'.$d.'"></i></button>
                    <button class="btn btn-sm btn-warning text-white"><i class="mdi mdi-lock" data-toggle="modal" data-target="#UserAccountReset" data-user_id="'.$d.'"></i></button>
                    <button class="btn btn-sm btn-danger text-white"><i class="mdi mdi-delete" data-toggle="modal" data-target="#UserAccountDelete" data-user_id="'.$d.'"></i></button>
                ';
            }

        },
        'field' => 'user_id'
    ),
);

    require '../../ssp.class.php';

$joinQuery = 'FROM `logins_view`';

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primary_key, $columns, $joinQuery)
);