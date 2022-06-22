<?php
require_once "User.php";

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'signup':
            doSignup();
            break;
        default:
            handleInvalidAction();
    }
} elseif (!empty($_GET)) {
    switch ($_GET['action']) {
        case 'login':
            doLogin();
            break;
        default:
            handleInvalidAction();
            break;
    }
}

function doLogin()
{
    $login_response = User::validate($_GET['email'], $_GET['passwd']);
    if (!$login_response) {
        echo json_encode([
            "error" => true,
            "message" => "Email ou senha incorretos",
            "code" => 404
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
        "code" => 200,
        "token" => $login_response['token']
    ], JSON_UNESCAPED_UNICODE);
    die();
}

function doSignup()
{
    if (User::userExists($_POST['email'])) {
        echo json_encode([
            "error" => true,
            "message" => "Um usuário com esse email já existe",
            "code" => 404
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    $added = User::addUser($_POST['name'], $_POST['email'], $_POST['passwd']);
    if (!$added) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível criar a conta. Tente novamente depois",
            "code" => 404
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
        "code" => 200
    ], JSON_UNESCAPED_UNICODE);
    die();
}

function handleInvalidAction()
{
}
