<?php
session_start();


if (!isset($_SESSION['usuario'])) {
    header("Location: views/login.php");
    exit();
}
?>
<?php require("./template/header.php") ?>
<?php require("./template/footer.php") ?>