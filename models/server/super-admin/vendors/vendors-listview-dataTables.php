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
    $table = 'vendors';

    // primary key of the table
    $primary_key = 'vendor_id';

    // get all columns to display
    $columns = [
        [
            'db' => 'vendor_name',
            'dt' => 0,
            'field' => 'vendor_name'
        ],
        [
            'db' => 'vendor_email',
            'dt' => 1,
            'field' => 'vendor_email'
        ],
        [
            'db' => 'vendor_contact',
            'dt' => 2,
            'field' => 'vendor_contact'
        ],
        [
            'db' => 'vendor_address',
            'dt' => 3,
            'field' => 'vendor_address'
        ],
        [
            'db' => 'vendor_city',
            'dt' => 4,
            'field' => 'vendor_city'
        ],
        [
            'db' => 'vendor_id',
            'dt' => 5,
            'formatter' => function ($d, $row) {
                return '
                    <a class="btn btn-sm btn-dark text-white"  data-toggle="modal" data-target="#ViewUpdateVendorModal" data-vendor_id="'.$d.'">Update</a>
                    <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#DeleteVendorModal" data-vendor_id="'.$d.'">Delete</a>
                ';
            },
            'field' => 'vendor_id'
        ],
    ];

    require '../../../ssp.class.php';

    $joinQuery = 'FROM `vendors`';

    echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primary_key, $columns, $joinQuery)
    );
