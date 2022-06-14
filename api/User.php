<?php
include_once __DIR__ . "/Database.php";

class User
{
    public static $DB;
    static function getUser($email, $passwd)
    {
        $response = self::$DB->execute("SELECT * FROM users WHERE email = '$email' AND password = '$passwd'");
        if (!$response) return [];
        return [
            "email" => $response["email"],
            "password" => $response["password"],
            "name" => $response["name"],
            "role" => $response["role"],
            "hash" => $response["hash"]
        ];
    }

    static function emailExists($email)
    {
        $response = self::$DB->execute("SELECT email FROM users WHERE email = '$email'");
        if (count($response) > 0) return true;
        return false;
    }

    static function validate($email, $hash)
    {
        try {
            $saved_hash = self::$DB->execute("SELECT hash FROM users WHERE email='$email'")["hash"];
            return ($saved_hash == $hash);
        } catch (Exception $e) {
            return false;
        }
    }

    static function createUser($email, $password, $role, $name)
    {
        if (User::emailExists($email)) {
            echo json_encode([
                "error" => true,
                "reason" => "O email fornecido já está cadastrado",
                "code" => 409
            ], JSON_UNESCAPED_UNICODE);
            die();
        }
        $hash = sha1("$email$name");
        $response = self::$DB->insert("INSERT INTO users (email, password, 'role', name, hash) VALUES ('$email',
        '$password', '$role', '$name', '$hash')");
        if (!$response) return false;
        return true;
    }
}

User::$DB = new Database();
