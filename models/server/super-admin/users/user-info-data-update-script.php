<?php

    include '../../../../config/sessions.php';
    include '../../../../config/constants.php';

    if(isset($_POST["user_fullname"]) && isset($_POST["user_dob"]) && isset($_POST["user_gender"]) && isset($_POST["user_placeOfBirth"]) && isset($_POST["user_address1"]) && isset($_POST["user_address2"]) && isset($_POST["user_mobile"]) && isset($_POST["user_contact"]) && isset($_POST["user_email"]) && isset($_POST["user_id"])){

        $user_fullname = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_fullname", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_dob = SanitizeInput(filter_input(INPUT_POST, "user_dob", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $user_gender = SanitizeInput(filter_input(INPUT_POST, "user_gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $user_placeOfBirth = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_placeOfBirth", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_address1 = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_address1", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_address2 = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_address2", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_mobile = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_mobile", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_contact = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_contact", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_email = SanitizeInput(filter_input(INPUT_POST, "user_email", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $validate_email = filter_var($user_email, FILTER_VALIDATE_EMAIL);
        $user_id = SanitizeInput(filter_input(INPUT_POST, "user_id"), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // validation check
        if(empty($user_fullname) || ($user_fullname == "")){
            $data = [
                'status' => 'failed',
                'msg' => 'FullName is required',
                'error' => null,
            ];
        }
        elseif(empty($user_dob) || ($user_dob == "")){
            $data = [
                'status' => 'failed',
                'msg' => 'Date of Birth is required',
                'error' => null,
            ];
        }
        elseif($user_gender == "-1"){
            $data = [
                'status' => 'failed',
                'msg' => 'Gender is required',
                'error' => null,
            ];
        }
        elseif(empty($user_placeOfBirth) || ($user_placeOfBirth == "")){
            $data = [
                'status' => 'failed',
                'msg' => 'Place of Birth is required',
                'error' => null,
            ];
        }
        elseif(empty($user_address1) || ($user_address1 == "")){
            $data = [
                'status' => 'failed',
                'msg' => 'Address is required',
                'error' => null,
            ];
        }
        elseif(empty($user_mobile) || ($user_mobile == "")){
            $data = [
                'status' => 'failed',
                'msg' => 'Mobile is required',
                'error' => null,
            ];
        }
        elseif(empty($user_email) || ($user_email == "")){
            $data = [
                'status' => 'failed',
                'msg' => 'Email Address is required',
                'error' => null,
            ];
        }
        elseif(!$validate_email){
            $data = [
                'status' => 'failed',
                'msg' => 'Valid email address required',
                'error' => null,
            ];
        }
        else{

            // database connection
            require('../../../../db/DataBaseClass.php');

            // Users Class
            require("../../../../controllers/UsersClass.php");

            $UserInfoUpdateObject = new Users;

            $user_info_update = $UserInfoUpdateObject->UserAccountUpdate($user_id, $user_name, $user_fullname, $user_dob, $user_gender, $user_placeOfBirth, $user_mobile, $user_contact, $user_email, $user_address1, $user_address2);

            $data = json_decode($user_info_update, TRUE);

        }

        echo json_encode($data);

    }