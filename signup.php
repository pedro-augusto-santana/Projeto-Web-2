<?php
require_once "./api/User.php";
if ($_COOKIE['croodtoken']) {
    if (User::validateToken($_COOKIE['croodtoken'])) {
        header("location: /home.php");
    }
}
?>
<head>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/signup.css">
    <title>Crood - Signup</title>
</head>

<div class="page-full signup-page__container">
    <div class="signup-page__form-container">
        <div class="signup-form__header">
            <span>Crood - Criar Conta</span>
        </div>
        <form method="POST" class="signup-page__form" id="signup-form">
            <div class="signup-form__input-line">
                <label for="name">Nome</label>
                <input class="signup-form__input" id="signup-name" type="text" name="name" placeholder="Digite seu nome: ">
            </div>

            <div class="signup-form__input-line">
                <label for="email">Email</label>
                <input class="signup-form__input" id="signup-email" type="text" name="email" placeholder="Digite seu email: ">
            </div>
            <div class="signup-form__input-line">
                <label for="passwd">Senha</label>
                <input class="signup-form__input" id="signup-passwd" type="password" name="passwd" placeholder="Digite sua senha: ">
            </div>
            <div class="signup-form__button-group">
                <p class="signup__has-account">Já tem conta? <span id="login-btn" class="pointer signup__login-click">Faça login!</span></p>
                <input type="submit" class="pointer signup__log-button" value="Criar conta">
            </div>
        </form>
    <div id="err-modal" style="display: none"></div>
    </div>
</div>

<script src="js/signup.js"></script>
<script src="js/utils.js"></script>

