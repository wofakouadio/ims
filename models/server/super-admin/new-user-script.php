<?php

    include '../../sessions.php';
    include '../../constants.php';

    if(isset($_POST["user_fullname"]) && isset($_POST["user_dob"]) && isset($_POST["user_gender"]) && isset($_POST["user_placeOfBirth"]) && isset($_POST["user_address1"]) && isset($_POST["user_address2"]) && isset($_POST["user_mobile"]) && isset($_POST["user_contact"]) && isset($_POST["user_email"]) && isset($_POST["user_type"]) && isset($_FILES["user_profile"]) && isset($_FILES["user_id_profile"])){

        $user_fullname = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_fullname", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_dob = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_dob", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_gender = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_placeOfBirth = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_placeOfBirth", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_address1 = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_address1", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_address2 = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_address2", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_mobile = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_mobile", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_contact = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_contact", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_email = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_email", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $validate_email = filter_var($user_email, FILTER_VALIDATE_EMAIL);
        $user_type = SanitizeInput(strtoupper(filter_input(INPUT_POST, "user_type", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user_profile_dir = "../../../user-files/";
        $valid_format = ["png", "jpg", "jpeg"];

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
        elseif($user_type == "-1"){
            $data = [
                'status' => 'failed',
                'msg' => 'Account Type is required',
                'error' => null,
            ];
        }else{

            // database connection
            require('../../../db/db-config.php');

            // Users Class
            require("../../../models/server/super-admin/UsersClass.php");

            $UserObject = new Users;
            $user_id = $UserObject->UserID();
            $user_name = $UserObject->CreateUserName($user_fullname);

            // user profile
            if(empty($_FILES["user_profile"]["name"]) || ($_FILES["user_profile"]["name"]) == ""){
                $user_profile = "user-default-profile.png";
            }else{

                $user_profile_name = $_FILES["user_profile"]["name"];
                $user_profile_Tmp = $_FILES["user_profile"]["tmp_name"];
                $user_profile_OE = explode(".", $user_profile_name);
                $user_profile_NE = strtolower(end($user_profile_OE));
                if(in_array($user_profile_NE, $valid_format)){
                    $user_profile = $user_id . time() . "." . $user_profile_NE;
                }else{
                    $data = [
                        'status' => 'failed',
                        'msg' => 'Invalid Profile Image uploaded. Preferred Format: png, jpg, jpeg',
                        'error' => null,
                    ];
                }

            }

            // user profile id
            if(empty($_FILES["user_id_profile"]["name"]) || ($_FILES["user_id_profile"]["name"]) == ""){
                $user_id_profile = "user-default-id.png";
            }else{

                $user_id_profile_name = $_FILES["user_id_profile"]["name"];
                $user_id_profile_Tmp = $_FILES["user_id_profile"]["tmp_name"];
                $user_id_profile_OE = explode(".", $user_id_profile_name);
                $user_id_profile_NE = strtolower(end($user_id_profile_OE));
                if(in_array($user_id_profile_NE, $valid_format)){
                    $user_id_profile = $user_id . time() . "." . $user_id_profile_NE;
                }else{
                    $data = [
                        'status' => 'failed',
                        'msg' => 'Invalid Profile Image uploaded. Preferred Format: png, jpg, jpeg',
                        'error' => null,
                    ];
                }

            }

            $user_registration = $UserObject->UserRegistration($user_id, $user_name, $user_fullname, $user_dob, $user_gender, $user_placeOfBirth, $user_mobile, $user_contact, $user_email, $user_address1, $user_address2, $user_type, $user_profile, $user_id_profile);

            $data = json_decode($user_registration, TRUE);

            if(!empty($_FILES["user_profile"]["name"]) || ($_FILES["user_profile"]["name"]) != ""){
                move_uploaded_file($user_profile_Tmp, $user_profile_dir . $user_profile);
                $img_source = $user_profile_dir . $user_profile;
                $img_compress = $user_profile_dir . $user_profile;
                ImageCompression($img_source, $img_compress);
            }

            if(!empty($_FILES["user_id_profile"]["name"]) || ($_FILES["user_id_profile"]["name"]) != ""){
                move_uploaded_file($user_id_profile_Tmp, $user_profile_dir . $user_id_profile);
                $img_source = $user_profile_dir . $user_id_profile;
                $img_compress = $user_profile_dir . $user_id_profile;
                ImageCompression($img_source, $img_compress);
            }

        }

        echo json_encode($data);

    }