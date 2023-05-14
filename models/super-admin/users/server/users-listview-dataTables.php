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
            'db' => 'user_profile',
            'dt' => 0,
            'formatter' => function ($d) {
                if (file_exists("../../../../user-files/$d")) {
                    return '<img src="../../../../user-files/'.$d.'" class="img rounded" width="50px"/>';
                } else {
                    return '<img src="../../../../user-files/user-default-profile.png" class="img rounded" width="50px"/>';
                }
            },
            'field' => 'user_profile'
        ),
        array(
            'db' => 'user_fullname',
            'dt' => 1,
            'field' => 'user_fullname'
        ),
        array(
            'db' => 'user_name',
            'dt' => 2,
            'field' => 'user_name'
        ),
        array(
            'db' => 'user_type',
            'dt' => 3,
            'field' => 'user_type'
        ),
        array(
            'db' => 'user_status',
            'dt' => 4,
            'formatter' => function ($d) {
                if ($d == 1) {
                    return '<span class="badge text-uppercase bg-success text-white">active</span>';
                } else {
                    return '<span class="badge text-uppercase bg-danger text-white">inactive</span>';
                }
            },
            'field' => 'user_status'
        ),
        array(
            'db' => 'user_loginBefore',
            'dt' => 5,
            'formatter' => function ($d) {
                if ($d == 1) {
                    return '<span class="badge text-uppercase bg-success text-white">yes</span>';
                } else {
                    return '<span class="badge text-uppercase bg-danger text-white">no</span>';
                }
            },
            'field' => 'user_loginBefore'
        ),
        array(
            'db' => 'user_id',
            'dt' => 6,
            'formatter' => function ($d, $row) {
                if ($row["user_type"] != "SUPER-ADMIN") {
                    return '
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" class="btn btn-sm btn-dark text-white"  data-toggle="modal" data-target="#UserAccountUpdate" data-user_id="'.$d.'">Update</a>
                            <a class="dropdown-item" class="btn btn-sm btn-success text-white"  data-toggle="modal" data-target="#UserIdentityUpdate" data-user_id="'.$d.'">Identity</a>
                            <a class="dropdown-item" class="btn btn-sm btn-primary text-white"  data-toggle="modal" data-target="#UserAccountType" data-user_id="'.$d.'">Account Type</a>
                            <a class="dropdown-item" class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#UserAccountStatus" data-user_id="'.$d.'">Account Status</a>
                            <a class="dropdown-item" class="btn btn-sm btn-warning text-white" data-toggle="modal" data-target="#UserAccountReset" data-user_id="'.$d.'">Reset Account</a>
                            <a class="dropdown-item" class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#UserAccountDelete" data-user_id="'.$d.'">Delete Account</a>
                        </div>
                    </div>
                ';
                }
            },
            'field' => 'user_id'
        ),
    );

    require '../../../ssp.class.php';

    $joinQuery = 'FROM `logins_view`';

    echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primary_key, $columns, $joinQuery)
    );
