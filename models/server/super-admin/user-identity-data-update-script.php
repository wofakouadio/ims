<?php

    include '../../sessions.php';
    include '../../constants.php';

    if(isset($_POST["user_id"]) && isset($_FILES["user_profile"]) && isset($_FILES["user_id_profile"])){

        $user_id = SanitizeInput(filter_input(INPUT_POST, "user_id"), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_profile_dir = "../../../user-files/";
        $valid_format = ["png", "jpg", "jpeg"];

        // database connection
        require('../../../db/db-config.php');

        // Users Class
        require("../../../models/server/super-admin/UsersClass.php");

        // user profile
        if(!empty($_FILES["user_profile"]["name"]) || ($_FILES["user_profile"]["name"]) != ""){

            $user_profile_name = $_FILES["user_profile"]["name"];
            $user_profile_Tmp = $_FILES["user_profile"]["tmp_name"];
            $user_profile_OE = explode(".", $user_profile_name);
            $user_profile_NE = strtolower(end($user_profile_OE));
            if(in_array($user_profile_NE, $valid_format)){

                $user_profile = $user_id . time() . "." . $user_profile_NE;
                $UserProfileObject = new Users;
                $user_profile_update = $UserProfileObject->UserAccountIdentityProfile($user_id, $user_profile);
                $data = json_decode($user_profile_update, TRUE);

                move_uploaded_file($user_profile_Tmp, $user_profile_dir . $user_profile);
                $img_source = $user_profile_dir . $user_profile;
                $img_compress = $user_profile_dir . $user_profile;
                ImageCompression($img_source, $img_compress);

            }else{
                $data = [
                    'status' => 'failed',
                    'msg' => 'Invalid Profile Image uploaded. Preferred Format: png, jpg, jpeg',
                    'error' => null,
                ];
            }

        }

        // user profile id
        if(!empty($_FILES["user_id_profile"]["name"]) || ($_FILES["user_id_profile"]["name"]) != ""){

            $user_id_profile_name = $_FILES["user_id_profile"]["name"];
            $user_id_profile_Tmp = $_FILES["user_id_profile"]["tmp_name"];
            $user_id_profile_OE = explode(".", $user_id_profile_name);
            $user_id_profile_NE = strtolower(end($user_id_profile_OE));
            if(in_array($user_id_profile_NE, $valid_format)){

                $user_id_profile = $user_id . time() . "." . $user_id_profile_NE;
                $UserIDProfile = new Users;
                $user_id_profileUpdate = $UserIDProfile->UserAccountIdentityScannedID($user_id, $user_id_profile);

                $data = json_decode($user_id_profileUpdate, TRUE);

                move_uploaded_file($user_id_profile_Tmp, $user_profile_dir . $user_id_profile);
                $img_source = $user_profile_dir . $user_id_profile;
                $img_compress = $user_profile_dir . $user_id_profile;
                ImageCompression($img_source, $img_compress);

            }else{
                $data = [
                    'status' => 'failed',
                    'msg' => 'Invalid ID Profile Image uploaded. Preferred Format: png, jpg, jpeg',
                    'error' => null,
                ];
            }

        }

        // user profile and user id profile
        if((!empty($_FILES["user_profile"]["name"]) || ($_FILES["user_profile"]["name"]) != "") && (!empty($_FILES["user_id_profile"]["name"]) || ($_FILES["user_id_profile"]["name"]) != "")){

            $user_profile_name = $_FILES["user_profile"]["name"];
            $user_profile_Tmp = $_FILES["user_profile"]["tmp_name"];
            $user_profile_OE = explode(".", $user_profile_name);
            $user_profile_NE = strtolower(end($user_profile_OE));

            $user_id_profile_name = $_FILES["user_id_profile"]["name"];
            $user_id_profile_Tmp = $_FILES["user_id_profile"]["tmp_name"];
            $user_id_profile_OE = explode(".", $user_id_profile_name);
            $user_id_profile_NE = strtolower(end($user_id_profile_OE));

            if(in_array($user_profile_NE, $valid_format)){

                if(in_array($user_id_profile_NE, $valid_format)){

                    $user_profile = $user_id . time() . "." . $user_profile_NE;
                    $user_id_profile = $user_id . time() . "." . $user_id_profile_NE;

                    $UserIdentityObject = new Users;
                    $user_identity_update = $UserIdentityObject->UserAccountIdentity($user_id, $user_profile, $user_id_profile);

                    $data = json_decode($user_identity_update, TRUE);

                    move_uploaded_file($user_profile_Tmp, $user_profile_dir . $user_profile);
                    $img_source = $user_profile_dir . $user_profile;
                    $img_compress = $user_profile_dir . $user_profile;
                    ImageCompression($img_source, $img_compress);

                    move_uploaded_file($user_id_profile_Tmp, $user_profile_dir . $user_id_profile);
                    $img_source = $user_profile_dir . $user_id_profile;
                    $img_compress = $user_profile_dir . $user_id_profile;
                    ImageCompression($img_source, $img_compress);

                }else{

                    $data = [
                    'status' => 'failed',
                    'msg' => 'Invalid ID Profile Image uploaded. Preferred Format: png, jpg, jpeg',
                    'error' => null,
                ];

                }

            }else{
                $data = [
                    'status' => 'failed',
                    'msg' => 'Invalid Profile Image uploaded. Preferred Format: png, jpg, jpeg',
                    'error' => null,
                ];
            }

        }

        // else if empty
        if((empty($_FILES["user_profile"]["name"]) || ($_FILES["user_profile"]["name"]) == "") && (empty($_FILES["user_id_profile"]["name"]) || ($_FILES["user_id_profile"]["name"]) == "")){

            $data = [
                    'status' => 'failed',
                    'msg' => 'Nothing to update here',
                    'error' => null,
                ];

        }


        echo json_encode($data);

    }