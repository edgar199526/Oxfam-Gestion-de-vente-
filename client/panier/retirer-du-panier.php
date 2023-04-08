<?php session_start();

include("../../config.php");

if(in_array($_GET['id_produit'], $_SESSION['cart'])){
    $new_cart = [];
    foreach ($_SESSION['cart'] as $produit) {
        if($_GET['id_produit'] != $produit){
            $new_cart[] = $produit;
        }
    }
}

$_SESSION['cart'] = $new_cart;


header('Location: '.$app_url.'client/panier/panier.php');