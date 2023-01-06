<?php

require_once('db-parameters.php');

    class DBCon {

        // protected $hostname = HOSTNAME;
        protected $username = USERNAME;
        protected $password = PASSWORD;
        // protected $database = DATABASE;
        protected $dsn = DNS;
        public $db_con = null;
        public $db_status;

        public function __construct(){
            // $hostname = $this->$hostname;
            // $password = $this->$password;
            // $username = $this->$username;
            // $database = $this->$database;
            $this->connectionString();
        }

        public function connectionString(){

            try {
                // setting up dn connection
                $this->db_con = new PDO($this->dsn, $this->username, $this->password);
                $this->db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
                $this->db_con = null;
            }

            return json_encode($this->db_status);
        }



    }