<?php

class Items extends DataBaseClass
{

    protected $item_number;
    protected $item_product_category;
    protected $item_name;
    protected $item_status;
    protected $item_description;
    protected $item_quantity;
    protected $item_unit_price;
    protected $item_discount;
    protected $item_file;
    protected $defaultPath;

    // function to load all product categories

    /**
     * @return string
     */
    public function ProductsCategories()
    {
        $sql = "SELECT `pc_name` FROM `product-categories` ORDER BY `pc_name` ASC";
        $stmt = $this->connectionString()->prepare($sql);
        $stmt->execute();
        $output = "";
        if($stmt->rowCount() == 0){
            $output .= "<option value='0'>No Category found</option>";
        }else{
            $output .= "<option value='0'>Choose</option>";
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $output .= "<option value='".$row->pc_name."'>".$row->pc_name."</option>";
            }
        }
        return $output;
        $this->closeConnectionString();
    }

    // function to save item data

    /**
     * @param $item_number
     * @param $item_product_category
     * @param $item_name
     * @param $item_file
     * @param $item_description
     * @param $item_quantity
     * @param $item_unit_price
     * @param $item_discount
     * @param $item_status
     * @return bool|string
     */
    public function AddNewItem($item_number, $item_product_category, $item_name, $item_file, $item_description, $item_quantity, $item_unit_price, $item_discount, $item_status)
    {

        $this->item_number = $item_number;
        $this->item_product_category = $item_product_category;
        $this->item_name = $item_name;
        $this->item_status = $item_status;
        $this->item_description = $item_description;
        $this->item_quantity = $item_quantity;
        $this->item_unit_price = $item_unit_price;
        $this->item_discount = $item_discount;
        $this->item_file = $item_file;
        $connection = $this->connectionString();
        $data = [];

        //check if item already exists
        $sql_exists = "SELECT * FROM `items` WHERE `item_number` = :item_number";
        $stmt_exists = $connection->prepare($sql_exists);
        $stmt_exists->bindValue(":item_number", $item_number, PDO::PARAM_STR);
        $stmt_exists->execute();

        if($stmt_exists->rowCount() > 0){
            $data = [
                'status' => 'failed',
                'msg' => 'Item already exists',
                'error' =>  null
            ];
        }else{
            $connection->beginTransaction();
            try {
                $sql_item = "INSERT INTO `items` (`item_number`, 
                     `item_name`, 
                     `item_description`, 
                     `item_file`, 
                     `item_product_category`,
                     `item_discount`,
                     `item_status`) VALUES (:item_number, :item_name, :item_description, :item_file, :item_product_category, :item_discount, :item_status)";
                $stmt_item = $connection->prepare($sql_item);
                $stmt_item->bindValue(":item_number", $item_number, PDO::PARAM_STR);
                $stmt_item->bindValue(":item_name", $item_name, PDO::PARAM_STR);
                $stmt_item->bindValue(":item_description", $item_description, PDO::PARAM_STR);
                $stmt_item->bindValue(":item_file", $item_file, PDO::PARAM_STR);
                $stmt_item->bindValue(":item_product_category", $item_product_category, PDO::PARAM_STR);
                $stmt_item->bindValue(":item_discount", $item_discount, PDO::PARAM_STR);
                $stmt_item->bindValue(":item_status", $item_status, PDO::PARAM_STR);
                $stmt_item->execute();

                $sql_stock = "INSERT INTO `stocks`(`item_number`, `stock_quantity`, `stock_price`) 
            VALUES(:item_number, :item_quantity, :item_price)";
                $stmt_stock = $connection->prepare($sql_stock);
                $stmt_stock->bindValue(":item_number", $item_number, PDO::PARAM_STR);
                $stmt_stock->bindValue(":item_quantity", $item_quantity, PDO::PARAM_STR);
                $stmt_stock->bindValue(":item_price", $item_unit_price, PDO::PARAM_STR);
                $stmt_stock->execute();

                $connection->commit();

                $data = [
                    'status' => 'success',
                    'msg' => $item_name . ' has been saved and stocked successful',
                    'error' => null
                ];
            } catch (\PDOException $th){
                $connection->rollBack();
                $data = [
                    'status' => 'failed',
                    'msg' => $item_name . ' has failed saving',
                    'error' => $th->getMessage()
                ];
            }
        }
        return json_encode($data);
        $connection->closeConnectionString();
    }

    //    Item Data

    /**
     * @param $item_number
     * @return bool|string
     */
    public function FetchItemData($item_number)
    {
        $this->item_number = $item_number;
        $connection = $this->connectionString();
        $data = [];

        $sql = "SELECT * FROM `items_view` WHERE `item_number` = :item_number";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":item_number", $item_number, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        $data = [
            'status' => 'success',
            'msg' => 'Data found',
            'data' => [
                'item_name' => $row->item_name,
                'item_description' => $row->item_description,
                'item_product_category' => $row->item_product_category,
                'item_discount' => $row->item_discount,
                'item_status' => $row->item_status,
                'stock_quantity' => $row->stock_quantity,
                'stock_price' => $row->stock_price,
                'stock_taker' => $row->stock_taker,
                'stock_timestamp' => $row->initial_stock_timestamp,
                'item_file' => $row->item_file
            ]
        ];
        return json_encode($data);
        $connection->closeConnectionString();
    }

    //Function to delete Item Files

    /**
     * @param $item_number
     * @param $defaultPath
     * @return bool|string
     */
    public function DeleteItemFiles($item_number, $defaultPath)
    {
        $this->defaultPath = $defaultPath;
        $this->item_number = $item_number;
        $itemData = $this->FetchItemData($item_number);
        $itemFiles = json_decode($itemData, TRUE);
        $item_file = $itemFiles["data"]["item_file"];
        if($item_file == "imageNotAvailable.jpg"){
            return json_encode([
                'status' => 200,
                'item_file' => $item_file
            ]);
        }else{
            $item_dir = is_dir($defaultPath . $item_number);
            $item_path = $defaultPath . $item_number . '/' . $item_file;
            return json_encode([
                'status' => 203,
                'item_file' => $item_path
            ]);
        }
    }

    //Function to delete item data

    /**
     * @param $item_number
     * @return bool|string
     */
    public function DeleteItemData($item_number)
    {
        $this->item_number = $item_number;
        $connection = $this->connectionString();

        $connection->beginTransaction();
        try {
            $sql_item = "DELETE FROM `items` WHERE `item_number` = :item_number";
            $stmt_item = $connection->prepare($sql_item);
            $stmt_item->bindValue(":item_number", $item_number, PDO::PARAM_INT);
            $stmt_item->execute();

            $sql_stock = "DELETE FROM `stocks` WHERE `item_number` = :item_number";
            $stmt_stock = $connection->prepare($sql_stock);
            $stmt_stock->bindValue(":item_number", $item_number, PDO::PARAM_INT);
            $stmt_stock->execute();

            $data = [
                'status' => 'success',
                'msg' => 'Item deleted successfully',
                'error' => null
            ];

            $connection->commit();

        } catch (\PDOException $exception){
            $connection->rollBack();
            $data = [
                'status' => 'failed',
                'msg' => 'Item unable to delete.',
                'error' => $exception->getMessage()
            ];
        }
        return json_encode($data);

        $connection->closeConnectionString();
    }

//    function to update item info and stock with uploaded image
    public function UpdateItemDataWithImage($item_number, $item_product_category, $item_name, $item_file, $item_description, $item_quantity, $item_unit_price, $item_discount, $item_status){
        $this->item_number = $item_number;
        $this->item_product_category = $item_product_category;
        $this->item_name = $item_name;
        $this->item_status = $item_status;
        $this->item_description = $item_description;
        $this->item_quantity = $item_quantity;
        $this->item_unit_price = $item_unit_price;
        $this->item_discount = $item_discount;
        $this->item_file = $item_file;
        $connection = $this->connectionString();
        $data = [];
        $connection->beginTransaction();
        try {
            $sql_item = "UPDATE `items` SET `item_name` = :item_name, 
                     `item_description` = :item_description, 
                     `item_file` = :item_file, 
                     `item_product_category` = :item_product_category,
                     `item_discount` = :item_discount,
                     `item_status` = :item_status WHERE `item_number` = :item_number";
            $stmt_item = $connection->prepare($sql_item);
            $stmt_item->bindValue(":item_number", $item_number, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_name", $item_name, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_description", $item_description, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_file", $item_file, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_product_category", $item_product_category, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_discount", $item_discount, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_status", $item_status, PDO::PARAM_STR);
            $stmt_item->execute();

            $sql_stock = "UPDATE `stocks` SET `stock_quantity` = :item_quantity WHERE  `stock_price` = :item_price WHERE `item_number` = :item_number";
            $stmt_stock = $connection->prepare($sql_stock);
            $stmt_stock->bindValue(":item_number", $item_number, PDO::PARAM_STR);
            $stmt_stock->bindValue(":item_quantity", $item_quantity, PDO::PARAM_STR);
            $stmt_stock->bindValue(":item_price", $item_unit_price, PDO::PARAM_STR);
            $stmt_stock->execute();

            $connection->commit();

            $data = [
                'status' => 'success',
                'msg' => $item_name . ' has been updated successful',
                'error' => null
            ];
        } catch (\PDOException $th){
            $connection->rollBack();
            $data = [
                'status' => 'failed',
                'msg' => $item_name . ' has failed updating',
                'error' => $th->getMessage()
            ];
        }
    }

//    function to update item data with no file image uploaded
    public function UpdateItemDataWithNoImage($item_number, $item_product_category, $item_name, $item_description, $item_quantity, $item_unit_price, $item_discount, $item_status){
        $this->item_number = $item_number;
        $this->item_product_category = $item_product_category;
        $this->item_name = $item_name;
        $this->item_status = $item_status;
        $this->item_description = $item_description;
        $this->item_quantity = $item_quantity;
        $this->item_unit_price = $item_unit_price;
        $this->item_discount = $item_discount;
        $connection = $this->connectionString();
        $data = [];
        $connection->beginTransaction();
        try {
            $sql_item = "UPDATE `items` SET `item_name` = :item_name, 
                     `item_description` = :item_description,
                     `item_product_category` = :item_product_category,
                     `item_discount` = :item_discount,
                     `item_status` = :item_status WHERE `item_number` = :item_number";
            $stmt_item = $connection->prepare($sql_item);
            $stmt_item->bindValue(":item_number", $item_number, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_name", $item_name, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_description", $item_description, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_product_category", $item_product_category, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_discount", $item_discount, PDO::PARAM_STR);
            $stmt_item->bindValue(":item_status", $item_status, PDO::PARAM_STR);
            $stmt_item->execute();

            $sql_stock = "UPDATE `stocks` SET `stock_quantity` = :item_quantity WHERE  `stock_price` = :item_price WHERE `item_number` = :item_number";
            $stmt_stock = $connection->prepare($sql_stock);
            $stmt_stock->bindValue(":item_number", $item_number, PDO::PARAM_STR);
            $stmt_stock->bindValue(":item_quantity", $item_quantity, PDO::PARAM_STR);
            $stmt_stock->bindValue(":item_price", $item_unit_price, PDO::PARAM_STR);
            $stmt_stock->execute();

            $connection->commit();

            $data = [
                'status' => 'success',
                'msg' => $item_name . ' has been updated successful',
                'error' => null
            ];
        } catch (\PDOException $th){
            $connection->rollBack();
            $data = [
                'status' => 'failed',
                'msg' => $item_name . ' has failed updating',
                'error' => $th->getMessage()
            ];
        }
    }
}
