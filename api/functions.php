<?php
session_start();

require_once "api.php";
require_once "User.php";
require_once "Product.php";
require_once "Seller.php";
require_once "Location.php";

API::register('login', 'doLogin');
API::register('signup', 'doSignup');
API::register('getCities', 'getCitiesByState');
API::register('newProduct', 'createProduct');
API::register('editProduct', 'editProduct');
API::register('deleteProduct', 'deleteProduct');
API::register('newSeller', 'createSeller');
API::register('editSeller', 'editSeller');
API::register('deleteSeller', 'deleteSeller');
API::register('deleteUser', 'deleteUser');
API::register('editUser', 'editUser');

if (!empty($_POST)) {
    API::execute($_POST['action']);
} elseif (!empty($_GET)) {
    API::execute($_GET['action']);
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

function deleteUser()
{
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

function deleteSeller()
{
    $products = Product::fromSeller($_POST['id']);
    if (count($products) > 0) {
        echo json_encode([
            "error" => true,
            "message" => "Há produtos cadastrados nesse fornecedor. Não é possível deletar.",
            "code" => 400
        ], JSON_UNESCAPED_UNICODE);
        die();
    }

    $resp = Seller::deleteSeller($_POST['id']);
    if (!$resp) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível deletar o fornecedor. Tente novamente depois",
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

function deleteProduct()
{
    $resp = Product::deleteProduct($_POST['id']);

    if (!$resp) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível deletar o produto. Tente novamente depois",
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

function getCitiesByState()
{
    $resp = Location::getByStateAbrv($_GET['state']);
    if (!$resp) {
        echo json_encode([
            "error" => true,
            "message" => "Não foi possível deletar o produto. Tente novamente depois",
            "code" => 400
        ], JSON_UNESCAPED_UNICODE);
        die();
    }
    $seller = [];
    if ($_GET['id']) {
        $seller = Seller::getSellerByID($_GET['id']);
        $seller['city'] = explode(" - ", $seller['city'], 2)[0];
    }

    $options = [];
    foreach ($resp as $city) {
        if ($_GET['id']) {
            $selected = $seller['city'] == $city['name'] ? "selected" : "";
            $options[] = "<option value=\"${city['name']}\" $selected>${city['name']}</option>";
        } else {
            $options[] = "<option value=\"${city['name']}\">${city['name']}</option>";
        }
    }

    echo json_encode([
        "error" => false,
        "data" => $options,
        "code" => 200
    ], JSON_UNESCAPED_UNICODE);
    die();
}
