<?php session_start();

include("../../config.php");

if(!in_array($_GET['id_produit'], $_SESSION['cart']))
    $_SESSION['cart'][] = $_GET['id_produit'];


header('Location: '.$app_url.'index.php');