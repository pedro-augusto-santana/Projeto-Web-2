<?php
require_once "Database.php";

class Product
{
    public static $DB;

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
}

Product::$DB = new Database();
