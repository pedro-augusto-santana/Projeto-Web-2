<?php
require_once "Database.php";

class Product
{
    public static $DB;

    static function addProduct($name, $sale_price, $buy_price, $quantity, $description, $seller)
    {
        $added = self::$DB->insert("INSERT INTO products (name,sale_price,buy_price,quantity,description,seller)
            VALUES ('$name',$sale_price,$buy_price,$quantity,'$description',$seller)");
        return $added;
    }

    static function productCount()
    {
        $product_count = self::$DB->query("SELECT COUNT() as count FROM products p");
        if (!$product_count) return 0;
        $product_count = $product_count->fetchArray(SQLITE3_ASSOC);
        return $product_count['count'];
    }

    static function stockAmount()
    {
        $stock_count = self::$DB->query("SELECT SUM(p.quantity) as amount FROM products p");
        if (!$stock_count) return 0;
        $stock_count = $stock_count->fetchArray(SQLITE3_ASSOC);
        return $stock_count['amount'];
    }

    static function totalRevenue()
    {
        $revenue = self::$DB->query("SELECT SUM(p.quantity * p.sale_price) as total_value FROM products p");
        if (!$revenue) return 0;
        $revenue = $revenue->fetchArray(SQLITE3_ASSOC);
        return number_format($revenue['total_value'], 2);
    }

    static function totalProductCost()
    {
        $stockCost = self::$DB->query("SELECT SUM(p.quantity * p.buy_price) as total_value FROM products p");
        if (!$stockCost) return 0;
        $stockCost = $stockCost->fetchArray(SQLITE3_ASSOC);
        return number_format($stockCost['total_value'], 2);
    }

    static function listProducts()
    {
        $product_list = self::$DB->query("SELECT * FROM products p");
        $result_set = [];
        if (!$product_list) return [];
        while ($row = $product_list->fetchArray(SQLITE3_ASSOC)) {
            $result_set[] = $row;
        }
        return $result_set;
    }

    static function getProductByID($id)
    {
        $product = self::$DB->query("SELECT * FROM products p WHERE p.id='$id'");
        if (!$product) return false;
        $product = $product->fetchArray(SQLITE3_ASSOC);
        return $product;
    }

    static function updateProduct($id, $name, $sale_price, $buy_price, $description, $seller, $quantity)
    {
        $update = self::$DB->query("UPDATE products SET name='$name', sale_price='$sale_price', buy_price='$buy_price',
            description='$description', seller='$seller', quantity=$quantity WHERE id=$id");
        if (!$update) return false;
        return true;
    }

    static function deleteProduct($id)
    {
        $update = self::$DB->query("DELETE FROM products WHERE id='$id'");
        if (!$update) return false;
        return true;
    }

    static function fromSeller($sellerID)
    {
        $product_list = self::$DB->query("SELECT p.id FROM products p WHERE p.seller = $sellerID");
        $result_set = [];
        if (!$product_list) return [];
        while ($row = $product_list->fetchArray(SQLITE3_ASSOC)) {
            $result_set[] = $row;
        }
        return $result_set;
    }
}

Product::$DB = new Database();
