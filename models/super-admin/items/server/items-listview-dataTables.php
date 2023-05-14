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
    $table = 'items';

    // primary key of the table
    $primary_key = 'item_id';

    // get all columns to display
    $columns = [
        [
            'db' => 'item_file',
            'dt' => 0,
            'formatter' => function($d, $row){
                if($d == 'imageNotAvailable.jpg')
                    return '<img src="../../../../items-files/imageNotAvailable.jpg" class="img rounded" width="100px">';
                else return '<img src="../../../../items-files/'.$row['item_number'].'/'.$d.'" class="img rounded" width="100px">';
            },
            'field' => 'item_file'
        ],
        [
            'db' => 'item_name',
            'dt' => 1,
            'field' => 'item_name'
        ],
        [
            'db' => 'item_product_category',
            'dt' => 2,
            'field' => 'item_product_category'
        ],
        [
            'db' => 'item_timestamp',
            'dt' => 3,
            'field' => 'item_timestamp'
        ],
        [
            'db' => 'item_status',
            'dt' => 4,
            'formatter' => function ($d) {
                if ($d == 1) {
                    return '<span class="badge text-uppercase bg-success text-white">active</span>';
                } else {
                    return '<span class="badge text-uppercase bg-danger text-white">inactive</span>';
                }
            },
            'field' => 'item_status'
        ],
        [
            'db' => 'item_number',
            'dt' => 5,
            'formatter' => function ($d, $row) {
                return '
                    <a class="btn btn-sm btn-dark text-white"  data-toggle="modal" data-target="#ViewUpdateItemModal" data-item_number="'.$d.'">Update</a>
                    <a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#DeleteItemModal" data-item_number="'.$d.'">Delete</a>
                ';
            },
            'field' => 'item_number'
        ],
    ];

    require '../../../ssp.class.php';

    $joinQuery = 'FROM `items`';

    echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primary_key, $columns, $joinQuery)
    );
