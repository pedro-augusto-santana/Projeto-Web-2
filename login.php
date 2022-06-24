<?php
require "./api/User.php";

if (!$_GET['new-session']) {
    if ($_COOKIE['croodtoken']) {
        if (User::validateToken($_COOKIE['croodtoken'])) {
            header("location: /home.php");
        }
    }
} else {
    unset($_COOKIE['croodtoken']);
    unset($_SESSION);
}
?>

<head>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Crood - Login</title>
</head>

<div class="page-full login-page__container">
    <div class="login-page__form-container">
        <div class="login-form__header">
            <span>Crood - Login</span>
        </div>
        <form method="POST" class="login-page__form" id="login-form">
            <div class="login-form__input-line">
                <label for="email">Email</label>
                <input class="login-form__input" id="login-email" type="email" name="email" placeholder="Digite seu email: " required>
            </div>
            <div class="login-form__input-line">
                <label for="passwd">Senha</label>
                <input class="login-form__input" id="login-passwd" type="password" name="passwd" placeholder="Digite sua senha: " required>
            </div>
            <div class="login-form__button-group">
                <p class="login__new-account">Ainda não tem acesso? <span id="newacc-btn" class="pointer login__new-account-click">Crie sua conta!</span></p>
                <input type="submit" class="pointer login__log-button" value="Login">
            </div>
        </form>
        <div id="err-modal" style="display: none"></div>
    </div>
</div>

<script src="js/login.js"></script>
<script src="js/utils.js"></script>
