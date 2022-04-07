<?php
include_once "includes/header.php";
include_once "includes/config.php";

$preview = new PreviewProvider($con, $_SESSION['userLoggedIn']); //kullanıcı giriş yaptı
echo $preview->createPreviewVideo(null);

$containers = new CategoryContainers($con, $_SESSION['userLoggedIn']);
echo $containers->showAllCategories();
