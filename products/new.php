<?php
session_start();

$required_lvl = 2;
if ($_SESSION['access'] < $required_lvl) {
    header("location: /products/view.php");
}
require_once "../api/Product.php";
require_once "../api/Seller.php";
?>

<head>
    <title>Crood - Editar Produto</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/products.css">
</head>

<div class="products__container">
    <?php require_once "../templates/sidebar.php" ?>
    <div class="products__content">
        <div class="products__header page__header">
            <span class="page-title">Produtos - Novo</span>
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
        <form class="form__edit" id="product-new__form">
            <div class="form-edit__line">
                <label for="name">Nome do produto</label>
                <input type="text" name="name" value="" required>
            </div>
            <div class="form-edit__line">
                <label for="sale_price">Preço de venda</label>
                <input type="text" name="sale_price" value="" required>
            </div>
            <div class="form-edit__line">
                <label for="buy_price">Preço de compra</label>
                <input type="text" name="buy_price" value="" required>
            </div>
            <div class="form-edit__line">
                <label for="name">Descrição</label>
                <input type="text" name="description" value="" required>
            </div>
            <div class="form-edit__line">
                <label for="name">Quantidade em estoque</label>
                <input type="text" name="quantity" value="" required>
            </div>
            <div class="form-edit__line">
                <label for="seller">Fornecedor</label>
                <!-- <input type="text" name="seller" value="" required> -->
                <select name="seller" class="form__select">
                    <?php foreach (Seller::listSellers() as $seller) : ?>
                        <option value="<?= $seller['id'] ?>"><?= $seller['id'] . ' - ' . $seller['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="btn__group">
                <input class="action__btn" type="submit" value="Salvar">
                <input id="cancel__btn" type="button" class="action__btn" value="Cancelar" onclick="window.location.href = '/products/view.php'">
            </div>
        </form>
    </div>
</div>
</div>

<script src="../js/index.js"></script>
<script src="./new.js"></script>
