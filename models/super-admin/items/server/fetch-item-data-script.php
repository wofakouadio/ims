<?php

    include '../../../../config/sessions.php';
    include '../../../../config/constants.php';

    if(isset($_GET["item-number"])){

        $item_number = SanitizeInput(strtoupper(filter_input(INPUT_GET, "item-number", FILTER_SANITIZE_NUMBER_INT)));

        // database connection
        require('../../../../db/DataBaseClass.php');

        // Users Class
        require("../../../../controllers/ItemsClass.php");

        $ItemObject = new Items();


        $item_data = $ItemObject->FetchItemData($item_number);

        $data = json_decode($item_data, TRUE);

        echo json_encode($data);

    }