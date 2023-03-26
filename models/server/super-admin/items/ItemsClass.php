<?php

class Items extends DBCon
{

    protected $item_number;
    protected $item_product_category;
    protected $item_name;
    protected $item_status;
    protected $item_description;
    protected $item_quantity;
    protected $item_unit_price;
    protected $item_total_stock;
    protected $item_discount;
    protected $item_file;

    // function to load all product categories
    public function ProductsCategories(){
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
    public function AddItem($item_number){
        
    }

}
