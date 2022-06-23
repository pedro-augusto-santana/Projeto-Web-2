<?php
session_start();
require_once "../api/Product.php";

$enableEdit = false;
if ($_SESSION['access'] > 1) $enableEdit = true;
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
            <div class="action__area">
                <span class="page-title">Produtos</span>
                <?php if ($enableEdit) : ?>
                    <button class="add-more__btn" onclick="window.location.href = '/products/new.php' ">Adicionar produto +</button>
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
        <div class="products__table crood-table__container">
            <table class="crood-table">
                <tr class="crood-table__line">
                    <th>#</th>
                    <th>Nome</th>
                    <th>Val. venda</th>
                    <th>Val. compra</th>
                    <th>Quantidade</th>
                    <th>Descrição</th>
                    <th>Fornecedor</th>
                    <th>Acão</th>
                </tr>
                <?php foreach (Product::listProducts() as $product) : ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['sale_price'] ?></td>
                        <td><?= $product['buy_price'] ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= $product['description'] ?></td>
                        <td><?= $product['seller'] ?></td>
                        <td class="line-action line-id-<?= $product['id'] ?>">
                            <div class="tr__action_group">
                                <span id="<?= $product['id'] ?>" class="material-symbols-sharp tr__action edit" style="color: green" onclick="window.location.href='/products/edit.php?id=<?= $product['id'] ?>'">
                                    edit_note
                                </span>
                                <?php if ($enableEdit) : ?>
                                    <span id="<?= $product['id'] ?>" class="material-symbols-sharp tr__action delete" style="color: #ff1313">
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
