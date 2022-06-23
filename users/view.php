<?php
session_start();
require_once "../api/User.php";

$enableEdit = false;
if ($_SESSION['access'] > 4) $enableEdit = true;
?>

<head>
    <title>Crood - Fornecedores</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/users.css">
</head>


<div class="users__container">
    <?php require_once "../templates/sidebar.php" ?>
    <div class="users__content">
        <div class="users__header page__header">
            <div class="action__area">
                <span class="page-title">Usuários</span>
            </div>
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
        <div class="users__table crood-table__container">
            <table class="crood-table">
                <tr class="crood-table__line">
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Acão</th>
                </tr>
                <?php foreach (user::listusers() as $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td style="text-align: center;"><?= $user['email'] ?></td>
                        <td style="text-align: center;"><?= $user['role'] ?></td>
                        <td class="line-action line-id-<?= $user['id'] ?>">
                            <div class="tr__action_group">
                                <span id="<?= $user['id'] ?>" class="material-symbols-sharp tr__action edit" style="color: green" onclick="window.location.href='/users/edit.php?id=<?= $user['id'] ?>'">
                                    edit_note
                                </span>
                                <?php if ($enableEdit) : ?>
                                    <span id="<?= $user['id'] ?>" class="material-symbols-sharp tr__action delete" style="color: #ff1313">
                                        delete_forever
                                    <?php endif ?>
                                    </span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>

<script src="../js/index.js"></script>
