<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crood</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
<?php
if (!$_COOKIE['croodtoken']) header("location: /login.php");
else header("location: /home.php");
?>
</body>

</html>
