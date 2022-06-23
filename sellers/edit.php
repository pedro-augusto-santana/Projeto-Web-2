<?php
session_start();
$required_lvl = 3;
if ($_SESSION['access'] < $required_lvl) {
    header("location: /sellers/view.php");
}
require_once "../api/Seller.php";
require_once "../api/Location.php";

$seller = Seller::getSellerByID($_GET['id']);
[$seller_city, $seller_state] = explode(" - ", $seller['city'], 2);
?>

<head>
    <title>Crood - Editar Produto</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/sellers.css">
</head>

<div class="sellers__container">
    <?php require_once "../templates/sidebar.php" ?>
    <div class="sellers__content">
        <div class="sellers__header page__header">
            <span class="page-title">Fornecedores - Editar</span>
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
        <form action="POST" class="form__edit" id="seller-edit__form">
            <div class="form-edit__line">
                <label for="name">Fornecedor</label>
                <input type="text" name="name" value="<?= $seller['name'] ?>" required>
            </div>
            <div class="form-edit__line">
                <label for="sale_price">Cidade</label>
                <!--<input type="text" name="city" value="<?= $seller['city'] ?>" required>-->
                <select name="state" id="state__select" class="location__select" required onchange="loadStateCities(event)">
                    <?php foreach (Location::listStates() as $state): ?>
                    <option value="<?= $state['abrv'] ?>" <?= $state['abrv'] == $seller_state ? "selected" : ""?>>
                            <?= $state['name'] . " - " . $state['abrv'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <select name="city" id="city__select" class="location__select"></select>
            </div>
            <div class="form-edit__line">
                <label for="buy_price">Gerente</label>
                <input type="text" name="manager" value="<?= $seller['manager'] ?>" required>
            </div>
            <div class="form-edit__line">
                <label for="name">Contato</label>
                <input type="email" name="email" value="<?= $seller['email'] ?>" required>
            </div>
            <div class="btn__group">
                <input class="action__btn" type="submit" value="Salvar">
                <input id="cancel__btn" type="button" class="action__btn" value="Cancelar" onclick="window.location.href = '/sellers/view.php'">
            </div>
        </form>
    </div>
</div>
</div>

<script src="../js/index.js"></script>
<script src="./edit.js"></script>
