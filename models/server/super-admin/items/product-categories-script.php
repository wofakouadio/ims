<?php

    include '../../../../config/sessions.php';
    include '../../../../config/constants.php';

        // database connection
        require('../../../../db/DataBaseClass.php');

        // Items Class
        require("../../../../controllers/ItemsClass.php");

        $ProductCategoryObject = new Items;

        $data = $ProductCategoryObject->ProductsCategories();

        echo $data;

