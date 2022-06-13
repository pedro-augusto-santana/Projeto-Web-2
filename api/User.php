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
            "role" => $response["role"]
        ];
    }

    static function emailExists($email)
    {
        $response = self::$DB->execute("SELECT email FROM users WHERE email = '$email'");
        if (count($response) > 0) return true;
        return false;
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

        $response = self::$DB->insert("INSERT INTO users (email, password, 'role', name) VALUES ('$email',
        '$password', '$role', '$name')");
        if (!$response) return false;
        return true;
    }

    static function getRole($email)
    {
        $response = self::$DB->execute("SELECT role FROM users WHERE email = $email");
        if (!$response) {
            echo json_encode(["error" => true, "reason" => "Usuário não encontrado", "code" => 404], JSON_UNESCAPED_UNICODE);
            die();
        }
        echo json_encode(["error" => false, "role" => $response]);
        die();
    }
}

User::$DB = new Database();
