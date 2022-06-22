<?php
session_destroy();
session_start();
require_once "./api/User.php";
require_once "./api/Product.php";

if (empty($_COOKIE['croodtoken'])) header("location: /login.php");

$userdata = User::getUser($_COOKIE['croodtoken']);
if (!$userdata) header("location: /login.php");
$_SESSION['name'] = $userdata['name'];
$_SESSION['role'] = $userdata['role'];
$_SESSION['access'] = $userdata['lvl'];
$_SESSION['email'] = $userdata['email'];
$_SESSION['token'] = $userdata['token'];
?>

<head>
    <title>Crood - Home</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<div class="homepage__container">
    <?php require_once "./templates/sidebar.php" ?>
    <div class="homepage__content">
        <div class="homepage__header page__header">
            <span class="page-title">Dashboard</span>
            <div class="user-area">
                <div class="header__greet">
                    <span class="welcome-message">Bem vindo, <?= $_SESSION['name'] ?></span>
                    <span class="material-symbols-sharp" style="margin-left: 15px">
                        person
                    </span>
                </div>
                <span id="logout-btn" style="margin-left: 15px;">Sair</span>
            </div>
        </div>
        <div class="homepage__main">
            <div class="homepage__metrics">
                <div class="metric__item">
                    <span class="metric__count"><?= Product::productCount() ?></span>
                    <span class="metric__description">produtos cadastrados</span>
                </div>
                <div class="metric__item">
                    <span class="metric__count"><?= User::userCount() ?></span>
                    <span class="metric__description">usuários cadastrados</span>
                </div>
                <div class="metric__item">
                    <span class="metric__count"><?= "412" ?></span>
                    <span class="metric__description">fornecedores parceiros</span>
                </div>
                <div class="metric__item">
                    <span class="metric__count"><?= Product::stockAmount() ?></span>
                    <span class="metric__description">produtos em estoque</span>
                </div>
                <div class="metric__item">
                    <span class="metric__count"><?= "R$ " . Product::totalRevenue() ?></span>
                    <span class="metric__description">valor de venda dos produtos em estoque</span>
                </div>
                <div class="metric__item">
                    <span class="metric__count"><?= "R$ " . Product::totalProductCost() ?></span>
                    <span class="metric__description">valor total dos produtos em estoque</span>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="./js/index.js"></script>
