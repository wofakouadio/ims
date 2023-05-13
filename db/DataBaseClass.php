<?php

//require database parameters
require('db-parameters.php');

    class DataBaseClass {
    protected $username = USERNAME;
    protected $password = PASSWORD;
    protected $dsn = DNS;
    protected $db_con = null;
    protected $db_status;

    public function __construct(){
        return $this->connectionString();
    }

    public function __destruct(){
        return $this->closeConnectionString();
    }

    public function connectionString()
    {

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
            $this->db_con = $this->closeConnectionString();
        }

        // return json_encode($this->db_status);
        return $this->db_con;

    }

    // close db connection
    public function closeConnectionString()
    {
        $this->db_con = null;
        return $this->db_con;
    }


}