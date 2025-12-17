<?php
// DETEKSI URL / POSISI FOLDER
$currentFile = $_SERVER['PHP_SELF'];
$isCategory = strpos($currentFile, '/category/') !== false;

// PATH DINAMIS
$basePath   = $isCategory ? "../" : "";
$cssPath    = $basePath . "assets/css/style.css";
$jsPath     = $basePath . "assets/js/cart.js";

// FUNGSI STATUS MENU AKTIF
function activeMenu($keyword) {
    return strpos($_SERVER['PHP_SELF'], $keyword) !== false ? "active" : "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6GunShop</title>
    <link rel="stylesheet" href="<?= $cssPath ?>">
    <script src="<?= $jsPath ?>"></script>
</head>

<body>

<header class="navbar">
    <div class="logo">6GunShop</div>
    <nav>
        <ul>
            <li><a class="<?= activeMenu('index') ?>" href="<?= $basePath ?>index.php">Home</a></li>
            <li><a class="<?= activeMenu('handgun') ?>" href="<?= $basePath ?>category/handgun.php">Handguns</a></li>
            <li><a class="<?= activeMenu('rifle') ?>" href="#">Rifles</a></li>
            <li><a class="<?= activeMenu('sniper') ?>" href="#">Sniper</a></li>
            <li><a class="<?= activeMenu('ammo') ?>" href="#">Ammunition</a></li>
            <li><a class="<?= activeMenu('extension') ?>" href="#">Extension</a></li>
        </ul>
    </nav>
</header>

<div class="page-content">


