<?php

    class LOGIN extends DBCon{

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
        protected $usr_profile;
        protected $user_id_profile;
        protected $user_timestamp;


        public function UserVerification($user_name){
            $this->user_name = $user_name;
            $select_sql = "SELECT * FROM `logins_view` WHERE `user_name` = :user_name";
            $connection = $this->connectionString();
            $stmt_sql = $connection->prepare($select_sql);
            $stmt_sql->bindValue(":user_name", $user_name, PDO::PARAM_STR);
            $stmt_sql->execute();

            try {

                if($stmt_sql->rowCount() == 0){
                    $data = [
                        'status' => 'failed',
                        'msg' => 'User not found',
                        'error' => null
                    ];
                }else{
                    $Row = $stmt_sql->fetch(PDO::FETCH_OBJ);

                    // if user status is 1 then
                    // if user loginBefore is 1 then
                    // allow the user to proceed to enter password page
                    if($Row->user_status == 1 && $Row->user_loginBefore == 1){

                        $_SESSION["user_fullname"] = $Row->user_fullname;
                        $_SESSION["user_name"] = $Row->user_name;
                        $_SESSION["user_id"] = $Row->user_id;
                        $_SESSION["user_type"] = $Row->user_type;

                        $data = [
                            'status' => 'success',
                            'msg' => 'Welcome back ' . $Row->user_fullname,
                            'error' => null,
                            'data' => [
                                'user_name' => $user_name,
                                'user_fullname' => $Row->user_fullname,
                                'user_id' => $Row->user_id,
                                'action' => 'EnterPassword',
                                'url' => 'user-login'
                            ]
                        ];

                    }
                    // if user status is 1 then
                    // user login before is 0 then
                    // allow the user to be redirected to create password page
                    elseif($Row->user_status == 1 && $Row->user_loginBefore == 0){

                        $_SESSION["user_fullname"] = $Row->user_fullname;
                        $_SESSION["user_name"] = $Row->user_name;
                        $_SESSION["user_id"] = $Row->user_id;
                        $_SESSION["user_type"] = $Row->user_type;

                        $data = [
                            'status' => 'success',
                            'msg' => 'Welcome ' . $Row->user_fullname . '. PLease Create Password.',
                            'error' => null,
                            'data' => [
                                'user_name' => $user_name,
                                'user_fullname' => $Row->user_fullname,
                                'user_id' => $Row->user_id,
                                'action' => "CreatePassword",
                                'url' => 'user-create-password'
                            ]
                        ];

                    }
                    // else user status is disabled set to 0
                    // which does not allow user to proceed and terminate the session
                    else{

                        $data = [
                            'status' => 'failed',
                            'msg' => 'Your account has been disabled.',
                            'error' => null,
                            'data' => []
                        ];

                    }

                }

            } catch (\PDOException $th) {
                //throw $th;
                $data = [
                    'status' => 'failed',
                    'msg' => 'Something went wrong',
                    'error' => $th->getMessage()
                ];
            }

            return json_encode($data);

        }


    }