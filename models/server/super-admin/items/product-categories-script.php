<?php

    include '../../../sessions.php';
    include '../../../constants.php';

        // database connection
        require('../../../../db/db-config.php');

        // Items Class
        require("../../../../models/server/super-admin/items/ItemsClass.php");

        $ProductCategoryObject = new Items;

        $data = $ProductCategoryObject->ProductsCategories();

        echo $data;

