<?php
session_start();
$required_lvl = 3;
if ($_SESSION['lvl'] < $required_lvl) {
    header("location: /403.php");
}
?>

<head>
    <title>Crood - Fornecedores</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/sellers.css">
</head>
<div class="sellers__container">
    <?php require_once "../templates/sidebar.php" ?>
    <div class="sellers__content">
        <div class="sellers__header page__header">
            <span class="page-title">Fornecedores</span>
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
        <div class="sellers__table crood__table">
        </div>
    </div>
</div>
<script src="../js/index.js"></script>

