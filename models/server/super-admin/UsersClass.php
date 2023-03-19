<?php

class Users extends DBCon
{

    protected $user_id;
    protected $user_name;
    protected $user_fullname;
    protected $user_dob;
    protected $user_gender;
    protected $user_placeofBirth;
    protected $user_mobile;
    protected $user_contact;
    protected $user_mail;
    protected $user_address_one;
    protected $user_address_two;
    protected $user_type;
    protected $user_status;
    protected $user_loginBefore;
    protected $user_password;
    protected $user_profile;
    protected $user_id_profile;

    // function to create userName using user full name
    public function CreateUserName($user_fullname)
    {

        $this->user_fullname = $user_fullname;
        // getting random digits to attach to userName
        $countName = explode(" ", $user_fullname);
        $base = "1234567890";
        $RandNum = substr(str_shuffle($base), 0, 3);

        // let check number of string in name
        if (count($countName) == 2) {

            $abbr_name = strtolower(substr($countName[0], 0, 1) . substr(end($countName), 0));
        } elseif (count($countName) == 3) {

            $abbr_name = strtolower(substr($countName[0], 0, 1) . substr($countName[1], 0, 1) . substr(end($countName), 0));
        } elseif (count($countName) >= 4) {
            $abbr_name = strtolower(substr($countName[0], 0, 1) . substr($countName[1], 0, 1) . substr($countName[2], 0, 1) . substr(end($countName), 0));
        }

        return strtolower($abbr_name . $RandNum);
    }

    // function to create user id
    public function UserID()
    {

        $get_table_sql = "SELECT * FROM `users`";
        $connection = $this->connectionString();
        $stmt_table = $connection->prepare($get_table_sql);
        $stmt_table->execute();

        if ($stmt_table->rowCount() == 0) {

            $count_from = 1;
            $curDate = date("my");
            $id = "IMS" . sprintf("%05d", $count_from) . "-" . $curDate;
        } else {

            $get_table_sql = "SELECT `user_id` FROM `users` ORDER BY `user_timestamp` DESC LIMIT 1";
            $stmt_table = $connection->prepare($get_table_sql);
            $stmt_table->execute();
            $table_row = $stmt_table->fetch(PDO::FETCH_OBJ);
            $last_table_id = $table_row->user_id;
            $decomposite = substr($last_table_id, -6);
            $count_from = intval($decomposite) + 1;
            $curDate = date("my");
            $id = "IMS" . sprintf("%05d", $count_from) . "-" . $curDate;
        }
        return $id;
    }
    // function to register new user
    public function UserRegistration($user_id, $user_name, $user_fullname, $user_dob, $user_gender, $user_placeofBirth, $user_mobile, $user_contact, $user_mail, $user_address_one, $user_address_two, $user_type, $user_profile, $user_id_profile)
    {

        // $this->user_id = $user_id;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->user_fullname = $user_fullname;
        $this->user_dob = $user_dob;
        $this->user_gender = $user_gender;
        $this->user_placeofBirth = $user_placeofBirth;
        $this->user_mobile = $user_mobile;
        $this->user_contact = $user_contact;
        $this->user_mail = $user_mail;
        $this->user_address_one = $user_address_one;
        $this->user_address_two = $user_address_two;
        $this->user_type = $user_type;
        $this->user_profile = $user_profile;
        $this->user_id_profile = $user_id_profile;
        $connection = $this->connectionString();

        // check if user already exists
        // sql query
        $chk_user_exists_sql = "SELECT * FROM `users` WHERE `user_fullname` = :user_fullname AND `user_type` = :user_type";
        $stmt_chk_user_exists = $connection->prepare($chk_user_exists_sql);
        $stmt_chk_user_exists->bindValue(":user_fullname", $user_fullname, PDO::PARAM_STR);
        $stmt_chk_user_exists->bindValue(":user_type", $user_type, PDO::PARAM_STR);
        $stmt_chk_user_exists->execute();

        // condition checking if user count is greater than 0
        // it means user exists already in the system
        if($stmt_chk_user_exists->rowCount() > 0){

            $data = [
                'status' => 'failed',
                'msg' => $user_fullname . ' Account already exists',
                'error' => null
            ];

        }else{

            try {

                // when condition checks count greater than zero
                // then insertion of new user data in the users table
                $user_insert_sql = "INSERT INTO `users`(`user_id`, `user_name`, `user_fullname`, `user_dob`, `user_gender`, `user_placeofBirth`, `user_mobile`, `user_contact`, `user_mail`, `user_address_one`, `user_address_two`, `user_type`, `user_profile`, `user_id_profile`) VALUES(:user_id, :user_name, :user_fullname, :user_dob, :user_gender, :user_placeofBirth, :user_mobile, :user_contact, :user_mail, :user_address_one, :user_address_two, :user_type, :user_profile, :user_id_profile)";
                $stmt_user_insert = $connection->prepare($user_insert_sql);
                $stmt_user_insert->bindValue(":user_id", $user_id, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_name", $user_name, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_fullname", $user_fullname, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_dob", $user_dob, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_gender", $user_gender, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_placeofBirth", $user_placeofBirth, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_mobile", $user_mobile, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_contact", $user_contact, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_mail", $user_mail, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_address_one", $user_address_one, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_address_two", $user_address_two, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_type", $user_type, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_profile", $user_profile, PDO::PARAM_STR);
                $stmt_user_insert->bindValue(":user_id_profile", $user_id_profile, PDO::PARAM_STR);
                $stmt_user_insert->execute();

                $data = [
                    'status' => 'success',
                    'msg' => $user_fullname . ' Account has been successfully created',
                    'error' => null
                ];

            } catch (\PDOException $th) {

                $data = [
                    'status' => 'failed',
                    'msg' => 'Something went wrong. ',
                    'error' => $th->getMessage()
                ];

            }

        }

        return json_encode($data);

    }


    // function to fetch user data
    public function FetchUserData($user_id){

        $this->user_id = $user_id;

        $select_user_data_sql = "SELECT `user_name`, `user_fullname`, `user_dob`, `user_gender`, `user_placeofBirth`, `user_mobile`, `user_contact`, `user_mail`, `user_address_one`, `user_address_two`, `user_type`, `user_profile`, `user_id_profile`, `user_timestamp`, `user_status`, `user_loginBefore` FROM `users` WHERE `user_id` = :user_id";
        $stmt_select_user_data = $this->connectionString()->prepare($select_user_data_sql);
        $stmt_select_user_data->bindValue(":user_id", $user_id, PDO::PARAM_STR);
        $stmt_select_user_data->execute();

        if($stmt_select_user_data->rowCount() == 0){

            $data = [
                'status' => 'failed',
                'msg' => 'User does not exist',
                'error' => null
            ];

        }else{

            $UserData = $stmt_select_user_data->fetch(PDO::FETCH_OBJ);

            $data = [
                'status' => 'success',
                'msg' => 'User does exist',
                'error' => null,
                'data' => [
                    'user_id' => $user_id,
                    'user_name' => $UserData->user_name,
                    'user_fullname' => $UserData->user_fullname,
                    'user_dob' => $UserData->user_dob,
                    'user_gender' => $UserData->user_gender,
                    'user_placeofBirth' => $UserData->user_placeofBirth,
                    'user_mobile' => $UserData->user_mobile,
                    'user_contact' => $UserData->user_contact,
                    'user_email' => $UserData->user_mail,
                    'user_address_one' => $UserData->user_address_one,
                    'user_address_two' => $UserData->user_address_two,
                    'user_type' => $UserData->user_type,
                    'user_profile' => $UserData->user_profile,
                    'user_id_profile' => $UserData->user_id_profile,
                    'user_timestamp' => $UserData->user_timestamp,
                    'user_status' => $UserData->user_status,
                    'user_loginBefore' => $UserData->user_loginBefore ,
                ]
            ];

        }

        return json_encode($data);

    }

    // Update User Account Data
    public function UserAccountUpdate($user_id, $user_name, $user_fullname, $user_dob, $user_gender, $user_placeofBirth, $user_mobile, $user_contact, $user_mail, $user_address_one, $user_address_two){

        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->user_fullname = $user_fullname;
        $this->user_dob = $user_dob;
        $this->user_gender = $user_gender;
        $this->user_placeofBirth = $user_placeofBirth;
        $this->user_mobile = $user_mobile;
        $this->user_contact = $user_contact;
        $this->user_mail = $user_mail;
        $this->user_address_one = $user_address_one;
        $this->user_address_two = $user_address_two;
        $connection = $this->connectionString();

        try {

            // sql query
            $user_insert_sql = "UPDATE `users` SET `user_fullname` = :user_fullname, `user_dob` = :user_dob, `user_gender` = :user_gender, `user_placeofBirth` = :user_placeofBirth, `user_mobile` = :user_mobile, `user_contact` = :user_contact, `user_mail` = :user_mail, `user_address_one` = :user_address_one, `user_address_two` = :user_address_two WHERE  `user_id` = :user_id";
            $stmt_user_insert = $connection->prepare($user_insert_sql);
            $stmt_user_insert->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt_user_insert->bindValue(":user_fullname", $user_fullname, PDO::PARAM_STR);
            $stmt_user_insert->bindValue(":user_dob", $user_dob, PDO::PARAM_STR);
            $stmt_user_insert->bindValue(":user_gender", $user_gender, PDO::PARAM_STR);
            $stmt_user_insert->bindValue(":user_placeofBirth", $user_placeofBirth, PDO::PARAM_STR);
            $stmt_user_insert->bindValue(":user_mobile", $user_mobile, PDO::PARAM_STR);
            $stmt_user_insert->bindValue(":user_contact", $user_contact, PDO::PARAM_STR);
            $stmt_user_insert->bindValue(":user_mail", $user_mail, PDO::PARAM_STR);
            $stmt_user_insert->bindValue(":user_address_one", $user_address_one, PDO::PARAM_STR);
            $stmt_user_insert->bindValue(":user_address_two", $user_address_two, PDO::PARAM_STR);
            $stmt_user_insert->execute();

            $data = [
                'status' => 'success',
                'msg' => $user_fullname . ' Account has been successfully updated',
                'error' => null
            ];

        } catch (\PDOException $th) {

            $data = [
                'status' => 'failed',
                'msg' => 'Something went wrong. ',
                'error' => $th->getMessage()
            ];

        }

        return json_encode($data);

    }


    // Update User Account Identity Profile
    public function UserAccountIdentityProfile($user_id, $user_profile){

        $this->user_id = $user_id;
        $this->user_profile = $user_profile;
        $connection = $this->connectionString();
        try {

            // sql
            $sql = "UPDATE `users` SET `user_profile` = :user_profile WHERE `user_id` = :user_id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":user_profile", $user_profile, PDO::PARAM_STR);
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->execute();

            $data = [
                'status' => 'success',
                'msg' => 'User Account Identity Profile Picture updated successfully',
                'error' => null
            ];

        } catch (\PDOException $th) {

            $data = [
                'status' => 'success',
                'msg' => 'User Account Identity Profile Picture failed updating',
                'error' => $th->getMessage()
            ];

        }
        return json_encode($data);
    }


    // Update User Account Identity ScannedID
    public function UserAccountIdentityScannedID($user_id, $user_id_profile){

        $this->user_id = $user_id;
        $this->user_id_profile = $user_id_profile;
        $connection = $this->connectionString();
        try {

            // sql
            $sql = "UPDATE `users` SET `user_id_profile` = :user_id_profile WHERE `user_id` = :user_id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":user_id_profile", $user_id_profile, PDO::PARAM_STR);
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->execute();

            $data = [
                'status' => 'success',
                'msg' => 'User Account Identity Scanned ID updated successfully',
                'error' => null
            ];

        } catch (\PDOException $th) {

            $data = [
                'status' => 'success',
                'msg' => 'User Account Identity Scanned ID failed updating',
                'error' => $th->getMessage()
            ];

        }
        return json_encode($data);
    }


    // Update User Identity
    public function UserAccountIdentity($user_id, $user_profile, $user_id_profile){

        $this->user_id = $user_id;
        $this->user_profile = $user_profile;
        $this->user_id_profile = $user_id_profile;
        $connection = $this->connectionString();
        try {

            // sql
            $sql = "UPDATE `users` SET `user_profile` = :user_profile, `user_id_profile` = :user_id_profile WHERE `user_id` = :user_id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":user_id_profile", $user_id_profile, PDO::PARAM_STR);
            $stmt->bindValue(":user_profile", $user_profile, PDO::PARAM_STR);
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->execute();

            $data = [
                'status' => 'success',
                'msg' => 'User Account Identity updated successfully',
                'error' => null
            ];

        } catch (\PDOException $th) {

            $data = [
                'status' => 'success',
                'msg' => 'User Account Identity failed updating',
                'error' => $th->getMessage()
            ];

        }
        return json_encode($data);

    }

    // Update User Account Type
    public function UserAccountType($user_id, $user_type){

        $this->user_id = $user_id;
        $this->user_type = $user_type;
        $connection = $this->connectionString();
        try {

            // sql
            $sql = "UPDATE `users` SET `user_type` = :user_type WHERE `user_id` = :user_id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":user_type", $user_type, PDO::PARAM_STR);
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->execute();

            $data = [
                'status' => 'success',
                'msg' => 'User Account Type updated successfully',
                'error' => null
            ];

        } catch (\PDOException $th) {

            $data = [
                'status' => 'success',
                'msg' => 'User Account Type failed updating',
                'error' => $th->getMessage()
            ];

        }
        return json_encode($data);
    }

    // Update User Account Status
    public function UserAccountStatus($user_status, $user_id){

        $this->user_id = $user_id;
        $this->user_type = $user_type;
        $connection = $this->connectionString();
        try {

            // sql
            $sql = "UPDATE `users` SET `user_status` = :user_status WHERE `user_id` = :user_id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":user_status", $user_status, PDO::PARAM_STR);
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->execute();

            $data = [
                'status' => 'success',
                'msg' => 'User Account Status updated successfully',
                'error' => null
            ];

        } catch (\PDOException $th) {

            $data = [
                'status' => 'success',
                'msg' => 'User Account Status failed updating',
                'error' => $th->getMessage()
            ];

        }
        return json_encode($data);
    }

    // Reset User Account Password
    public function UserAccountPassword($user_id){

        $this->user_id = $user_id;
        $connection = $this->connectionString();
        try {

            // sql
            $sql = "UPDATE `users` SET `user_loginBefore` = :user_loginBefore WHERE `user_id` = :user_id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":user_loginBefore", 0, PDO::PARAM_INT);
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->execute();

            $data = [
                'status' => 'success',
                'msg' => 'User Account reset successfully',
                'error' => null
            ];

        } catch (\PDOException $th) {

            $data = [
                'status' => 'success',
                'msg' => 'User Account failed reset',
                'error' => $th->getMessage()
            ];

        }
        return json_encode($data);
    }

    // User Account Deletion
    public function UserAccountDelete($user_id){

        $this->user_id = $user_id;
        $connection = $this->connectionString();
        try {

            // sql
            $sql = "DELETE FROM `users` WHERE `user_id` = :user_id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->execute();

            $data = [
                'status' => 'success',
                'msg' => 'User Account deleted successfully',
                'error' => null
            ];

        } catch (\PDOException $th) {

            $data = [
                'status' => 'success',
                'msg' => 'User Account failed to be deleted',
                'error' => $th->getMessage()
            ];

        }
        return json_encode($data);
    }

}
