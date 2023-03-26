<?php

require('db-parameters.php');

    class DBCon {

        // protected $hostname = HOSTNAME;
        protected $username = USERNAME;
        protected $password = PASSWORD;
        // protected $database = DATABASE;
        protected $dsn = DNS;
        protected $db_con = null;
        protected $db_transaction;
        protected $db_status;

        public function __construct(){
            // $hostname = $this->$hostname;
            // $password = $this->$password;
            // $username = $this->$username;
            // $database = $this->$database;
            $this->db_con = $this->connectionString();
        }

        public function connectionString(){

            try {
                // setting up dn connection
                $this->db_transaction = new PDO($this->dsn, $this->username, $this->password);
                $this->db_transaction->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $this->db_status = array(
                    'status' => 'success',
                    'msg' => 'Connection to DB successful done',
                    'error' => null
                );

            } catch (PDOException $e) {
                $this->db_status = array(
                    'status' => 'failed',
                    'msg' => 'Connection to DB failed to created',
                    'error' => $e->getMessage()
                );
                $this->db_transaction = null;
            }

            // return json_encode($this->db_status);
            return $this->db_transaction;

        }

        // close db connection
        public function closeConnectionString(){

            $this->db_con = null;

        }



    }