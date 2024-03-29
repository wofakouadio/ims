<?php

    class LOGIN extends DataBaseClass {

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
        protected $user_new_password;
        // protected $user_confirm_password;
        protected $usr_profile;
        protected $user_id_profile;
        protected $user_timestamp;


        public function UserVerification($user_name){
            $this->user_name = $user_name;
            $select_sql = "SELECT `user_id`, `user_fullname`, `user_type`, `user_status`, `user_loginBefore` FROM `logins_view` WHERE `user_name` = :user_name";
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
                        $_SESSION["user_name"] = $user_name;
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
                        $_SESSION["user_name"] = $user_name;
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


        // function to verify user password
        public function UserLogin($user_name, $user_password){

            // initialize variable
            $this->user_name = $user_name;
            $this->user_password = $user_password;
            // query
            $select_sql = "SELECT * FROM `logins_view` WHERE `user_name` = :user_name";
            $connection = $this->connectionString();
            $stmt_sql = $connection->prepare($select_sql);
            $stmt_sql->bindValue(":user_name", $user_name, PDO::PARAM_STR);
            $stmt_sql->execute();

            try {
                $Row = $stmt_sql->fetch(PDO::FETCH_OBJ);
                $HashedPass = $Row->user_password;

                // if user password matches with fetched password
                if(password_verify($user_password, $HashedPass)){
                    // check user type and redirect where appropriate
                    // usr type = super admin
                    if($Row->user_type == "SUPER-ADMIN"){

                        $_SESSION["user_fullname"] = $Row->user_fullname;
                        $_SESSION["user_name"] = $user_name;
                        $_SESSION["user_id"] = $Row->user_id;
                        $_SESSION["user_type"] = $Row->user_type;

                        $data = [
                            'status' => 'success',
                            'msg' => 'Login Successful',
                            'error' => null,
                            'data' => [
                                'action' => 'login-success',
                                'url' => 'sa/'
                            ]
                        ];

                    }
                    // user type = admin
                    elseif($Row->user_type == "ADMIN"){

                        $_SESSION["user_fullname"] = $Row->user_fullname;
                        $_SESSION["user_name"] = $user_name;
                        $_SESSION["user_id"] = $Row->user_id;
                        $_SESSION["user_type"] = $Row->user_type;

                        $data = [
                            'status' => 'success',
                            'msg' => 'Login Successful',
                            'error' => null,
                            'data' => [
                                'action' => 'login-success',
                                'url' => 'ad/'
                            ]
                        ];

                    }
                    // user type = sales
                    elseif($Row->user_type == "SALES"){

                        $_SESSION["user_fullname"] = $Row->user_fullname;
                        $_SESSION["user_name"] = $user_name;
                        $_SESSION["user_id"] = $Row->user_id;
                        $_SESSION["user_type"] = $Row->user_type;

                        $data = [
                            'status' => 'success',
                            'msg' => 'Login Successful',
                            'error' => null,
                            'data' => [
                                'action' => 'login-success',
                                'url' => 'sales/'
                            ]
                        ];

                    }
                    // user type = vendor
                    elseif($Row->user_type == "VENDOR"){

                        $_SESSION["user_fullname"] = $Row->user_fullname;
                        $_SESSION["user_name"] = $user_name;
                        $_SESSION["user_id"] = $Row->user_id;
                        $_SESSION["user_type"] = $Row->user_type;

                        $data = [
                            'status' => 'success',
                            'msg' => 'Login Successful',
                            'error' => null,
                            'data' => [
                                'action' => 'login-success',
                                'url' => 'v/'
                            ]
                        ];

                    }
                    // user type = customer
                    elseif($Row->user_type == "CUSTOMER"){

                        $_SESSION["user_fullname"] = $Row->user_fullname;
                        $_SESSION["user_name"] = $user_name;
                        $_SESSION["user_id"] = $Row->user_id;
                        $_SESSION["user_type"] = $Row->user_type;

                        $data = [
                            'status' => 'success',
                            'msg' => 'Login Successful',
                            'error' => null,
                            'data' => [
                                'action' => 'login-success',
                                'url' => 'ad/'
                            ]
                        ];

                    }

                }else{

                    $data = [
                        'status' => 'failed',
                        'msg' => 'You have entered a wrong password',
                        'error' => null
                    ];

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


        // method to allow user to create new password
        public function UserPasswordCreation($user_name, $user_new_password){

            // Initialize variables
            $this->user_name = $user_name;
            $this->user_new_password = $user_new_password;

            // hash password
            $HashedPass = password_hash($user_new_password, PASSWORD_DEFAULT);

            // update use password
            try {

                $sql = "UPDATE `users` SET `user_password` = :user_new_password, `user_loginBefore` = :logged_in WHERE `user_name` = :user_name";
                $stmt = $this->connectionString()->prepare($sql);
                $stmt->bindValue(":user_new_password", $HashedPass, PDO::PARAM_STR);
                $stmt->bindValue(":user_name", $user_name, PDO::PARAM_STR);
                $stmt->bindValue(":logged_in", 1, PDO::PARAM_INT);
                $stmt->execute();

                $data = [
                    'status' => 'success',
                    'msg' => 'Password created successfully',
                    'error' => null
                ];

            } catch (\PDOException $th) {

                $data = [
                    'status' => 'failed',
                    'msg' => 'Something went wrong',
                    'error' => $th->getMessage()
                ];

            }

            return json_encode($data);

        }


    }