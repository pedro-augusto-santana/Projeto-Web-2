<?php
session_start();

require_once "User.php";
require_once "Product.php";
require_once "Seller.php";

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'signup':
            doSignup();
            break;
        case 'editProduct':
            editProduct();
            break;
        case 'newProduct':
            createProduct();
            break;
        case 'editSeller':
            editSeller();
            break;
        case 'newSeller':
            createSeller();
            break;
        case 'editUser':
            editUser();
            break;
        case 'deleteUser':
            deleteUser();
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
            "code" => 409
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
            "code" => 409
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    [$added, $token] = User::addUser($_POST['name'], $_POST['email'], $_POST['passwd']);
    if (!$added) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível criar a conta. Tente novamente depois",
            "code" => 400
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
        "token" => $token,
        "code" => 200
    ], JSON_UNESCAPED_UNICODE);
    die();
}

function editProduct()
{
    $resp = Product::updateProduct($_POST['id'], $_POST['name'], $_POST['sale_price'], $_POST['buy_price'], $_POST['description'], $_POST['seller'], $_POST['quantity']);
    if (!$resp) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível atualizar o produto. Tente novamente depois",
            "code" => 400
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
        "code" => 200
    ], JSON_UNESCAPED_UNICODE);
    die();
}

function createProduct()
{
    $resp = Product::addProduct($_POST['name'], $_POST['sale_price'], $_POST['buy_price'], $_POST['quantity'], $_POST['description'], $_POST['seller']);
    if (!$resp) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível criar o produto",
            "code" => 400
        ], JSON_UNESCAPED_UNICODE);
        die();
    }
    echo json_encode([
        "error" => false,
        "code" => 200
    ], JSON_UNESCAPED_UNICODE);
    die();
}

function createSeller()
{
    $added = Seller::addSeller($_POST['name'], $_POST['city'], $_POST['manager'], $_POST['email']);
    if (!$added) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível criar o fornecedor",
            "code" => 400
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
        "code" => 200
    ], JSON_UNESCAPED_UNICODE);
    die();
}

function editSeller()
{
    $resp = Seller::updateSeller($_POST['id'], $_POST['name'], $_POST['city'], $_POST['manager'], $_POST['email']);
    if (!$resp) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível atualizar o fornecedor. Tente novamente depois",
            "code" => 400
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
        "code" => 200
    ], JSON_UNESCAPED_UNICODE);
    die();
}

function editUser()
{
    $resp = User::updateUser($_POST['id'], $_POST['name'], $_POST['email'], $_POST['role']);
    if (!$resp) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível atualizar o usuário. Tente novamente depois",
            "code" => 400
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    echo json_encode([
        "error" => false,
        "code" => 200
    ], JSON_UNESCAPED_UNICODE);
    die();
}

function deleteUser() {
    $resp = User::deleteUser($_POST['id']);
    if (!$resp) {
    echo json_encode([
        "error" => true,
        "message" => "Não foi possível deletar o usuário. Tente novamente depois",
        "code" => 400
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
