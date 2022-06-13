<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;900&display=swap" rel="stylesheet">
    <title>Crood</title>
</head>

<body>
    <?php
    $location = $_SERVER['REQUEST_URI'];
    switch ($location) {
        case "/signup":
            require __DIR__ . "/pages/signup.php";
            break;
        case "/home":
            require __DIR__ . "/pages/home.php";
            break;
        case "/products":
            require __DIR__ . "/pages/products.php";
            break;
        case "/login":
        default:
            require __DIR__ . "/pages/login.php";
            break;
    }
    ?>
</body>
</html>
