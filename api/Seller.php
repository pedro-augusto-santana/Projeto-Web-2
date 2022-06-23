<?php
require_once "Database.php";

class Seller
{
    public static $DB;

    static function addSeller($name, $city, $manager, $email)
    {
        $added = self::$DB->insert("INSERT INTO sellers (name,city,manager,email)
	VALUES ('$name','$city','$manager','$email');");
        return $added;
    }

    public static function sellerCount()
    {
        $seller_count = self::$DB->query("SELECT COUNT() as count FROM sellers s");
        if (!$seller_count) return 0;
        $seller_count = $seller_count->fetchArray(SQLITE3_ASSOC);
        return $seller_count['count'];
    }

    public static function listSellers()
    {
        $seller_list = self::$DB->query("SELECT * FROM sellers s ORDER BY id ASC");
        $result_set = [];
        if (!$seller_list) return [];
        while ($row = $seller_list->fetchArray(SQLITE3_ASSOC)) {
            $result_set[] = $row;
        }
        return $result_set;
    }

    public static function getSellerByID($id)
    {
        $seller = self::$DB->query("SELECT * FROM sellers s WHERE s.id='$id'");
        if (!$seller) return false;
        $seller = $seller->fetchArray(SQLITE3_ASSOC);
        return $seller;
    }

    static function updateSeller($id, $name, $city, $manager, $email)
    {
        $update = self::$DB->query("UPDATE sellers SET city='$city',name='$name',manager='$manager',
            email='$email'WHERE id=$id");
        if (!$update) return false;
        return true;
    }

    static function deleteSeller($id)
    {
        $update = self::$DB->query("DELETE FROM sellers WHERE id='$id'");
        if (!$update) return false;
        return true;
    }
}
Seller::$DB = new Database();
