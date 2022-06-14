<?php
include_once __DIR__ . "/User.php";

$target = $_GET;
switch ($_GET['action']) {
    case 'validate':
        validateAccess();
        break;
    default:
        echo json_encode([
            "error" => true,
            "reason" => "Invalid action",
            "code" => 500
        ], JSON_UNESCAPED_UNICODE);
        die();
}

function validateAccess()
{
    $hash = $_GET['hash'];
    $email = $_GET['email'];
    if (!User::emailExists($email)) {
        echo json_encode([
            "error" => true,
            "reason" => "O email não existe no banco de dados"
        ], JSON_UNESCAPED_UNICODE);
        die();
    }
    if (!User::validate($email, $hash)) {
        echo json_encode([
            "error" => true,
            "reason" => "Falha na validação de login"
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
    ], JSON_UNESCAPED_UNICODE);
    die();
}
