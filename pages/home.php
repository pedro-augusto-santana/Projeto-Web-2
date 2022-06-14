<script>
    if (!window.sessionStorage.getItem('email')) {
        window.location.href = "/login";
    }

    fetch(`api/api.php?action=validate&email=${window.sessionStorage.getItem('email')}&hash=${window.sessionStorage.getItem('hash')}`, {})
        .then((response) => response.json())
        .then((response) => {
            if (response.error) {
                window.location.href = "/login";
            }
        });
</script>
<style>
    <?php include_once __DIR__ . "/home.css"; ?>
</style>

<div class="home-page-content">
<?php include_once dirname(__DIR__) . "/templates/sidebar.php" ?>
<?php include_once dirname(__DIR__) . "/templates/home_header.php" ?>
</div>
<script src="pages/home.js"></script>
