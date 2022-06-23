<?php
session_start();

$required_lvl = 4;
if ($_SESSION['access'] < $required_lvl) {
    header("location: /home.php");
}
require_once "../api/User.php";
$user = User::getUserByID($_GET['id']);
?>

<head>
    <title>Crood - Editar Usuário</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/users.css">
</head>

<div class="users__container">
    <?php require_once "../templates/sidebar.php" ?>
    <div class="users__content">
        <div class="users__header page__header">
            <span class="page-title">Usuário - Editar</span>
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
        <form action="POST" class="form__edit" id="user-edit__form">
            <div class="form-edit__line">
                <label for="name">Nome</label>
                <input type="text" name="name" value="<?= $user['name'] ?>" required>
            </div>
            <div class="form-edit__line">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-edit__line">
                <label for="role">Cargo</label>
                <!-- <input type="text" name="role" value="<?= $user['role'] ?>" required> -->
                <select name="role" class="form__select">
                    <option value="1" <?= $user['role'] == 'admin' ? "selected" : "" ?>>Admin</option>
                    <option value="2" <?= $user['role'] == 'supervisor' ? "selected" : "" ?>>Supervisor</option>
                    <option value="3" <?= $user['role'] == 'manager' ? "selected" : "" ?>>Gerente</option>
                    <option value="4" <?= $user['role'] == 'user' ? "selected" : "" ?>>Usuário</option>
                </select>
            </div>
            <div class="btn__group">
                <input class="action__btn" type="submit" value="Salvar">
                <input id="cancel__btn" type="button" class="action__btn" value="Cancelar" onclick="window.location.href = '/users/view.php'">
            </div>
        </form>
    </div>
</div>
</div>

<script src="../js/index.js"></script>
<script src="./edit.js"></script>
