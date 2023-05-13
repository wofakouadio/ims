<?php

    include '../../../../config/sessions.php';
    include '../../../../config/constants.php';

    if(isset($_POST["item-product-category"])
        && isset($_POST["item-number"])
        && isset($_POST["item-name"])
        && isset($_POST["item-status"])
        && isset($_POST["item-description"])
        && isset($_POST["item-quantity"])
        && isset($_POST["item-unit-price"])
        && isset($_POST["item-discount"])
        && isset($_FILES["item-image"])
    ){
        $item_number = SanitizeInput(filter_input(INPUT_POST, "item-number", FILTER_SANITIZE_NUMBER_INT));
        $item_name = SanitizeInput(strtoupper(filter_input(INPUT_POST, "item-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $item_description = strtoupper(filter_input(INPUT_POST, "item-description", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $item_quantity = SanitizeInput(filter_input(INPUT_POST, "item-quantity", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $item_product_category = filter_input(INPUT_POST, "item-product-category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $item_unit_price = SanitizeInput(filter_input(INPUT_POST, "item-unit-price", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $item_discount = SanitizeInput(filter_input(INPUT_POST, "item-discount", FILTER_SANITIZE_NUMBER_FLOAT));
        $item_status = SanitizeInput(filter_input(INPUT_POST, "item-status", FILTER_SANITIZE_NUMBER_INT));
        $valid_extensions = ["jpeg", "jpg", "png"];
//        $item_dir = "../../../../items-files/";
        $directory = "../../../../items-files/".$item_number;
        $data = [];
        $item_file = "";

        //validation
        if (empty($item_number) || !(filter_var($item_number, FILTER_VALIDATE_INT))){
            $data = [
                'status' => 'failed',
                'msg' => 'Item Number is required and must be digits ONLY',
                'error' => null
            ];
        }
        elseif(empty($item_name)){
            $data = [
                'status' => 'failed',
                'msg' => 'Item Name is required',
                'error' => null
            ];
        }
        elseif(empty($item_quantity) || !(filter_var($item_quantity, FILTER_VALIDATE_INT))){
            $data = [
                'status' => 'failed',
                'msg' => 'Item Quantity is required and must be digits ONLY',
                'error' => null
            ];
        }
        elseif($item_product_category === "0"){
            $data = [
                'status' => 'failed',
                'msg' => 'Product Category is required',
                'error' => null
            ];
        }
        elseif(empty($item_unit_price) || !(filter_var($item_unit_price, FILTER_VALIDATE_FLOAT))){
            $data = [
                'status' => 'failed',
                'msg' => 'Unit Price is required',
                'error' => null
            ];
        }
        elseif(empty($item_discount) || !is_numeric($item_discount)){
            $data = [
                'status' => 'failed',
                'msg' => 'Item Discount is required',
                'error' => null
            ];
        }
        elseif($item_status === "0"){
            $data = [
                'status' => 'failed',
                'msg' => 'Item Status is required',
                'error' => null
            ];
        }
        else{
            // database connection
            require('../../../../db/DataBaseClass.php');

            // Items Class
            require("../../../../controllers/ItemsClass.php");

            //Initialization
            $NewItemObject = new Items;

            // let get image file ready for upload
            if(empty($_FILES["item-image"]["name"])){
                $item_file = "imageNotAvailable.jpg";
                $new_item_added = $NewItemObject->AddNewItem($item_number, $item_product_category, $item_name, $item_file, $item_description, $item_quantity, $item_unit_price, $item_discount, $item_status);
                $data = json_decode($new_item_added, TRUE);
            }else{
                $item_file_name = $_FILES["item-image"]["name"];
                $item_file_tmp = $_FILES["item-image"]["tmp_name"];
                $item_file_OE = explode(".", $item_file_name);
                $item_file_NE = strtolower(end($item_file_OE));
                // let check if item file dir has been created
                if(!is_dir($directory)){
                    mkdir($directory); // create item directory based on item number
                    if(in_array($item_file_NE, $valid_extensions)){
                        $item_file = $item_number . time() . "." . $item_file_NE;
                        $new_item_added = $NewItemObject->AddNewItem($item_number, $item_product_category, $item_name, $item_file, $item_description, $item_quantity, $item_unit_price, $item_discount, $item_status);
                        $data = json_decode($new_item_added, TRUE);
                        move_uploaded_file($item_file_tmp, $directory . "/" . $item_file);
                        $img_source = $directory . "/" . $item_file;
                        $img_compress = $directory . "/" . $item_file;
                        ImageCompression($img_source, $img_compress);
                    }else{
                        $data = [
                            'status' => 'failed',
                            'msg' => 'Invalid format',
                            'error' => null
                        ];
                    }
                }else{
                    $data = [
                        'status' => 'failed',
                        'msg' => 'Directory failed to be created',
                        'error' => null
                    ];
                }

            }

        }

        echo json_encode($data);

    }