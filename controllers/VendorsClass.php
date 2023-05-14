<?php

class VendorsClass extends DataBaseClass
{
    protected $vendor_id;
    protected $vendor_name;
    protected $vendor_email_address;
    protected $vendor_contact;
    protected $vendor_phone;
    protected $vendor_address;
    protected $vendor_address_two;
    protected $vendor_city;
    protected $vendor_status;
    protected $response = [];
    protected $output;

    //

    // Method to save new vendor
    /**
     * @param $vendor_id
     * @param $vendor_name
     * @param $vendor_email_address
     * @param $vendor_contact
     * @param $vendor_phone
     * @param $vendor_address
     * @param $vendor_address_two
     * @param $vendor_city
     * @return false|string
     */
    public function CreateNewVendor($vendor_id, $vendor_name, $vendor_email_address, $vendor_contact, $vendor_phone, $vendor_address, $vendor_address_two, $vendor_city){
        $this->vendor_id = $vendor_id;
        $this->vendor_name = $vendor_name;
        $this->vendor_email_address = $vendor_email_address;
        $this->vendor_contact = $vendor_contact;
        $this->vendor_phone = $vendor_phone;
        $this->vendor_address = $vendor_address;
        $this->vendor_address_two = $vendor_address_two;
        $this->vendor_city = $vendor_city;
        $connection = $this->connectionString();

        //check if vendor data exists
        $sqlCheck = "SELECT * FROM  `vendors` WHERE `vendor_name` = :vendor_name OR `vendor_email` = :vendor_email";
        $stmtCheck = $connection->prepare($sqlCheck);
        $stmtCheck->bindValue(":vendor_name", $vendor_name, PDO::PARAM_STR);
        $stmtCheck->bindValue(":vendor_email", $vendor_email_address, PDO::PARAM_STR);
        $stmtCheck->execute();
        if($stmtCheck->rowCount() > 0){
            $this->response = [
                'status' => 201,
                'msg' => $vendor_name . ' vendor already exists'
            ];
        }else{
            try {
                $sqlInsert = "INSERT INTO `vendors`(`vendor_id`, `vendor_name`, `vendor_email`, `vendor_contact`, `vendor_mobile`, `vendor_address`, `vendor_address_two`, `vendor_city`) VALUES(:vendor_id, :vendor_name, :vendor_email, :vendor_contact, :vendor_mobile, :vendor_address, :vendor_address_two, :vendor_city)";
                $stmtInsert = $connection->prepare($sqlInsert);
                $stmtInsert->bindValue(":vendor_name", $vendor_name, PDO::PARAM_STR);
                $stmtInsert->bindValue(":vendor_email", $vendor_email_address, PDO::PARAM_STR);
                $stmtInsert->bindValue(":vendor_contact", $vendor_contact, PDO::PARAM_STR);
                $stmtInsert->bindValue(":vendor_mobile", $vendor_phone, PDO::PARAM_STR);
                $stmtInsert->bindValue(":vendor_address", $vendor_address, PDO::PARAM_STR);
                $stmtInsert->bindValue(":vendor_address_two", $vendor_address_two, PDO::PARAM_STR);
                $stmtInsert->bindValue(":vendor_city", $vendor_city, PDO::PARAM_STR);
                $stmtInsert->bindValue(":vendor_id", $vendor_id, PDO::PARAM_STR);
                $stmtInsert->execute();

                $this->response = [
                    'status' => 200,
                    'msg' => $vendor_name . ' Vendor registered successfully'
                ];
            } catch(\PDOException $e){
                $this->response = [
                    'status' => 201,
                    'msg' => 'Something went wrong. Error : ' . $e->getMessage()
                ];
            }
        }
        return json_encode($this->response);
        $connection = $this->closeConnectionString();
    }

    // Method to get vendor data

    /**
     * @param $vendor_id
     * @return false|string
     */
    public function GetVendorData($vendor_id){
        $this->vendor_id = $vendor_id;
        $connection = $this->connectionString();
        $sql = "SELECT * FROM `vendors` WHERE `vendor_id` = :vendor_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":vendor_id", $vendor_id, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            $this->response = [
                'status' => 201,
                'msg' => 'Data not found'
            ];
        }else{
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            $this->response = [
                'status' => 200,
                'msg' => 'Data found',
                'data' => [
                    'vendor_id' => $vendor_id,
                    'vendor_name' => $row->vendor_name,
                    'vendor_email' => $row->vendor_email,
                    'vendor_contact' => $row->vendor_contact,
                    'vendor_mobile' => $row->vendor_mobile,
                    'vendor_address' => $row->vendor_address,
                    'vendor_address_two' => $row->vendor_address_two,
                    'vendor_city' => $row->vendor_city,
                    'vendor_status' => $row->vendor_status,
                    'vendor_datetime' => $row->vendor_datetime
                ]
            ];
        }
        return json_encode($this->response);
        $connection = $this->closeConnectionString();
    }

    // Method to update Vendor data

    /**
     * @param $vendor_id
     * @param $vendor_name
     * @param $vendor_email_address
     * @param $vendor_contact
     * @param $vendor_phone
     * @param $vendor_address
     * @param $vendor_address_two
     * @param $vendor_city
     * @param $vendor_status
     * @return false|string
     */
    public function UpdateVendorData($vendor_id, $vendor_name, $vendor_email_address, $vendor_contact, $vendor_phone, $vendor_address, $vendor_address_two, $vendor_city, $vendor_status){
        $this->vendor_id = $vendor_id;
        $this->vendor_name = $vendor_name;
        $this->vendor_email_address = $vendor_email_address;
        $this->vendor_contact = $vendor_contact;
        $this->vendor_phone = $vendor_phone;
        $this->vendor_address = $vendor_address;
        $this->vendor_address_two = $vendor_address_two;
        $this->vendor_city = $vendor_city;
        $this->vendor_status = $vendor_status;
        $connection = $this->connectionString();

        try {
            $sql = "UPDATE `vendors` SET `vendor_name` = :vendor_name, `vendor_email` = :vendor_email, `vendor_contact` = :vendor_contact, `vendor_mobile` = :vendor_mobile, `vendor_address` = :vendor_address, `vendor_address_two` = :vendor_address_two, `vendor_city` = :vendor_city, `vendor_status` = :vendor_status WHERE `vendor_id` = :vendor_id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":vendor_name", $vendor_name, PDO::PARAM_STR);
            $stmt->bindValue(":vendor_email", $vendor_email_address, PDO::PARAM_STR);
            $stmt->bindValue(":vendor_contact", $vendor_contact, PDO::PARAM_STR);
            $stmt->bindValue(":vendor_mobile", $vendor_phone, PDO::PARAM_STR);
            $stmt->bindValue(":vendor_address", $vendor_address, PDO::PARAM_STR);
            $stmt->bindValue(":vendor_address_two", $vendor_address_two, PDO::PARAM_STR);
            $stmt->bindValue(":vendor_city", $vendor_city, PDO::PARAM_STR);
            $stmt->bindValue(":vendor_status", $vendor_status, PDO::PARAM_INT);
            $stmt->bindValue(":vendor_id", $vendor_id, PDO::PARAM_STR);
            $stmt->execute();
            $this->response = [
                'status' => 200,
                'msg' => $vendor_name . ' information updated successfully'
            ];
        }catch (\PDOException $e){
            $this->response = [
                'status' => 201,
                'msg' => 'Something went wrong. Error : ' . $e->getMessage()
            ];
        }
        return json_encode($this->response);
        $connection = $this->closeConnectionString();
    }

    //Method to delete vendor data

    /**
     * @param $vendor_id
     * @return false|string
     */
    public function DeleteVendorData($vendor_id){
        $this->vendor_id = $vendor_id;
        $connection = $this->connectionString();
        try {
            $sql = "DELETE FROM `vendors` WHERE `vendor_id` = :vendor_id";
            $stmt = $connection->prepare($sql);
            $stmt->prepare(":vendor_id", $vendor_id, PDO::PARAM_STR);
            $stmt->execute();
            $this->response = [
                'status' => 200,
                'msg' => 'Vendor Data delete successfully'
            ];
        }catch (\PDOException $e){
            $this->response = [
                'status' => 201,
                'msg' => 'Something went wrong. Error : ' . $e->getMessage()
            ];
        }
        return json_encode($this->response);
        $connection = $this->closeConnectionString();
    }

    //Method to fetch vendors in dropdown list

    /**
     * @return string
     */
    public function VendorsDropdownListByName(){
        $connection = $this->connectionString();
        $sql = "SELECT `vendor_name` FROM `vendors` ORDER BY `vendor_name` ASC";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            $this->output = "<option value=''>No Vendors found</option>";
        }else{
            $this->output = "<option value=''>Choose</option>";
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $this->output .= "<option value='".$row->vendor_name."'>".$row->vendor_name."</option>";
            }
        }
        return $this->output;
        $connection = $this->closeConnectionString();
    }

    //Method to fetch vendors in dropdown list

    /**
     * @return string
     */
    public function VendorsDropdownListByID(){
        $connection = $this->connectionString();
        $sql = "SELECT `vendor_id` FROM `vendors` ORDER BY `vendor_name` ASC";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            $this->output = "<option value=''>No Vendors found</option>";
        }else{
            $this->output = "<option value=''>Choose</option>";
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $this->output .= "<option value='".$row->vendor_id."'>".$row->vendor_id."</option>";
            }
        }
        return $this->output;
        $connection = $this->closeConnectionString();
    }
}