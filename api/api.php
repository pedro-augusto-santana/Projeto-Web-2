<?php
class API
{
    private static $methods = [];

    public static function register($action, $callback)
    {
        self::$methods[$action] = $callback;
    }

    public static function execute($action)
    {
        try {
            self::$methods[$action]();
        } catch (OutOfRangeException $e) {
            echo json_encode([
                "error" => true,
                "code" => 500,
                "message" => "Invalid action"
            ], JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
