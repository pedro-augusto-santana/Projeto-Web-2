<?php
require_once "Database.php";

class User
{
    public static $DB;
    static function userCount()
    {
        $user_count = self::$DB->query("SELECT COUNT() as count FROM users u");
        if (!$user_count) return 0;
        $user_count = $user_count->fetchArray(SQLITE3_ASSOC);
        return $user_count['count'];
    }

    static function getUser($token)
    {
        $user = self::$DB->query("SELECT u.email, u.name, u.role, r.lvl FROM users u, roles r WHERE u.role = r.id AND u.token = '$token'");
        if (!$user) return false;
        return $user->fetchArray(SQLITE3_ASSOC);
    }

    static function getRole($email)
    {
        $user = self::$DB->query("SELECT role FROM users WHERE email='$email'");
        if (!$user) return false;
        return $user->fetchArray(SQLITE3_ASSOC);
    }

    static function validate($email, $passwd)
    {
        $user = self::$DB->query("SELECT role, token FROM users WHERE email='$email' and pass='$passwd'");
        if (!$user) return false;
        return $user->fetchArray(SQLITE3_ASSOC);
    }

    static function validateToken($token)
    {
        $user = self::$DB->query("SELECT role FROM users WHERE token='$token'");
        return (bool) $user;
    }

    static function userExists($email)
    {
        $user = self::$DB->query("SELECT email FROM users WHERE email='$email'");
        $user = $user->fetchArray(SQLITE3_ASSOC);
        if (!$user) return false;
        return true;
    }

    static function addUser($name, $email, $passwd)
    {
        $token = sha1("$email$passwd");
        $new_user = self::$DB->insert("INSERT INTO users (name, email, pass, token) VALUES ('$name', '$email', '$passwd', '$token')");
        return [$new_user, $token];
    }
};

User::$DB = new Database();
