<?php
session_start();
?>

<head>
    <title>Crood - Produtos</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/products.css">
</head>
<div class="products__container">
    <?php require_once "../templates/sidebar.php" ?>
    <div class="products__content">
        <div class="products__header page__header">
            <span class="page-title">Produtos</span>
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
        <div class="products__table crood__table">
        </div>
    </div>
</div>
<script src="../js/index.js"></script>

