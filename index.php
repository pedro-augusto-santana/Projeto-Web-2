<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
