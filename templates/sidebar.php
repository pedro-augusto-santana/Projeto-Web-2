<?php
function isCurrent($current)
{
    return strpos($_SERVER['REQUEST_URI'], $current);
}

$menu_items = [
    [
        "slug" => "Dashboard",
        "linkto" => "/home.php",
        "access" => 1,
        "icon" => "auto_awesome_mosaic",
        "activename" => "home"
    ],
    [
        "slug" => "Produtos",
        "linkto" => "/products/view.php",
        "access" => 1,
        "icon" => "shopping_bag",
        "activename" => "products"
    ],
    [
        "slug" => "Fornecedores",
        "linkto" => "/sellers/view.php",
        "access" => 2,
        "icon" => "local_shipping",
        "activename" => "sellers"
    ],
    [
        "slug" => "Users",
        "linkto" => "/users/view.php",
        "access" => 4,
        "icon" => "admin_panel_settings",
        "activename" => "users"
    ]
];

$menu_items = array_filter($menu_items, function ($item) {
    return $_SESSION['access'] >= $item['access'];
});
?>

<style>
    .sidebar__container {
        display: flex;
        flex-direction: column;
        width: 12%;
        min-width: 256px;
        height: 100%;
        background-color: black;
        color: white;
    }

    .sidebar-menu__header {
        height: 64px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 22px;
    }

    .sidebar-menu__container {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
    }

    .sidebar-menu__item {
        padding: 15px 25px;
        width: 100%;
        height: 64px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .sidebar-menu__item:hover,
    .active {
        cursor: pointer;
        background-color: #004E98;
    }
</style>

<div class="sidebar__container">
    <div class="sidebar-menu__header">
        Crood
    </div>
    <div class="sidebar-menu__container">
        <?php foreach ($menu_items as $item) : ?>
            <div class="sidebar-menu__item <?= isCurrent($item['activename']) ? "active" : "" ?>" onclick="window.location.href = '<?= $item['linkto'] ?>'">
                <span><?= $item['slug'] ?></span>
                <span class="material-symbols-sharp" style="margin-left: 15px">
                    <?= $item['icon'] ?>
                </span>
            </div>
        <?php endforeach ?>

    </div>
</div>
