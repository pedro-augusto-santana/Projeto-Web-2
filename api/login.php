<?php
include_once __DIR__ . "/User.php";

if (empty($_POST)) {
    $_POST = json_decode(file_get_contents('php://input', true), true);
}

$action = $_POST['action'];

switch ($action) {
    case "login":
        validateLogin();
        break;
    case "signup":
        registerUser();
        break;
    default:
        echo json_encode([
            "error" => true,
            "reason" => "Invalid action",
            "code" => 500
        ], JSON_UNESCAPED_UNICODE);
        die();
}

function validateLogin()
{
    $resp = User::getUser($_POST['email'], $_POST['password']);
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo json_encode([
            "error" => true,
            "reason" => "Por favor preencha todos os campos",
            "code" => 500
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    if (!$resp) {
        echo json_encode([
            "error" => true,
            "reason" => "Não foi possível encontrar esse usuário, por favor verifique as credenciais.",
            "code" => 404
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
        "token" => $resp['hash'],
        "role" => $resp["role"],
        "name" => $resp["name"]
    ], JSON_UNESCAPED_UNICODE);
    die();
}

function registerUser()
{
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['name'])) {
        echo json_encode([
            "error" => true,
            "reason" => "Por favor preencha todos os campos",
            "code" => 500
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    $resp = User::createUser($_POST['email'], $_POST['password'], $_POST['role'], $_POST['name']);
    if (!$resp) {
        echo json_encode([
            "error" => true,
            "reason" => "Não foi possível criar o usuário, por favor tente novamente",
            "code" => 500
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
        "reason" => "Usuário criado com sucesso!",
        "code" => 201
    ], JSON_UNESCAPED_UNICODE);
    die();
}
