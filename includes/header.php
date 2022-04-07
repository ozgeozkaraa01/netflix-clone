<?php
include_once "config.php";
include_once "classes/PreviewProvider.php";
include_once "classes/CategoryContainers.php";
include_once "classes/Entity.php";
include_once "classes/EntityProvider.php";
include_once "classes/ErrorMessage.php";
include_once "classes/SeasonProvider.php";
include_once "classes/Season.php";
include_once "classes/Video.php";
include_once "classes/VideoProvider.php";


if (!isset($_SESSION["userLoggedIn"])) {
    header("Location: index.php");
}

$userLoggedIn = $_SESSION["userLoggedIn"];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Netflix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/06a651c8da.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <a href="logout.php" id="btn-logout">Çıkış Yap</a>
    <div class='wrapper'>