<?php

    include '../../../sessions.php';
    include '../../../constants.php';

    if(isset($_GET["item-number"])){

        $item_number = SanitizeInput(strtoupper(filter_input(INPUT_GET, "item-number", FILTER_SANITIZE_NUMBER_INT)));

        // database connection
        require('../../../../db/db-config.php');

        // Users Class
        require("../../../../models/server/super-admin/items/ItemsClass.php");

        $ItemObject = new Items();

        $dir = "../../../../items-files/";

        $item_data = $ItemObject->DeleteItemFiles($item_number, $dir);

        $data = json_decode($item_data, TRUE);

        echo json_encode($data);

    }