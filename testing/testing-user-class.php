<?php
    require '../db/db-config.php';
    require '../models/server/super-admin/UsersClass.php';

    $UserObject = new Users;

    $user_fullname = "bennett francis kouadio";
    $user_dob = "12-02-1946";
    $user_gender = "Female";
    $user_placeofBirth = "ablekuma";
    $user_mobile = "1234567890";
    $user_contact = "1234567890";
    $user_mail = "marytucson@mail.com";
    $user_address_one = "lorem ipsum";
    $user_address_two = "";
    $user_type = "ADMIN";
    $user_profile = "profile" .time(). $UserObject->UserID();
    $user_id_profile = "id" . time().$UserObject->UserID();

    echo "User ID : " . $UserObject->UserID() . "<br/>";

    echo "UserName : " . $UserObject->CreateUserName($user_fullname) . "<br/>";

    // echo "User Registration : " . $UserObject->UserRegistration($user_fullname, $user_dob, $user_gender, $user_placeofBirth, $user_mobile, $user_contact, $user_mail, $user_address_one, $user_address_two, $user_type, $user_profile, $user_id_profile) . "<br/>";

    echo $UserObject->FetchUserData("IMS00001-0123");


