<?php
session_start();
require_once "../api/Seller.php";

$enableEdit = false;
if ($_SESSION['access'] >= 3) $enableEdit = true;
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
            <div class="action__area">
                <span class="page-title">Fornecedores</span>
                <?php if ($enableEdit) : ?>
                    <button class="add-more__btn" onclick="window.location.href = '/sellers/new.php' ">Adicionar fornecedor +</button>
                <?php endif ?>
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
        <div class="sellers__table crood-table__container">
            <table class="crood-table">
                <tr class="crood-table__line">
                    <th>#</th>
                    <th>Nome</th>
                    <th>Cidade</th>
                    <th>Gerente</th>
                    <th>Contato</th>
                    <th>Acão</th>
                </tr>
                <?php foreach (Seller::listSellers() as $seller) : ?>
                    <tr>
                        <td><?= $seller['id'] ?></td>
                        <td><?= $seller['name'] ?></td>
                        <td><?= $seller['city'] ?></td>
                        <td><?= $seller['manager'] ?></td>
                        <td style="text-align: left;"><?= $seller['email'] ?></td>
                        <td class="line-action line-id-<?= $seller['id'] ?>">
                            <div class="tr__action_group">
                                <span id="<?= $seller['id'] ?>" class="material-symbols-sharp tr__action edit" style="color: green" onclick="window.location.href='/sellers/edit.php?id=<?= $seller['id'] ?>'">
                                    edit_note
                                </span>
                                <?php if ($enableEdit) : ?>
                                    <span id="<?= $seller['id'] ?>" class="material-symbols-sharp tr__action seller_delete" style="color: #ff1313" onclick="deleteSeller(event)">
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
<script src="./delete.js"></script>
