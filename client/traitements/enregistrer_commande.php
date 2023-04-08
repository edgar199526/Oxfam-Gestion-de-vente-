<?php session_start();
include("../../config.php");
include("../../fonctions.php");

$lignes_commande = array();

foreach ($_SESSION['cart'] as $id_produit) {
    array_push($lignes_commande, 
        array(
            "fk_product" => $id_produit,
            "qty" => 1
        )
    );
}

$commande = array(
    "socid" => $_SESSION['id_client'],
    "date" => time(),
    "lines" => $lignes_commande
);

$command = CallAPI("POST", $apiKey, $apiUrl."orders", json_encode($commande)); 

if(is_numeric($command)){
    $_SESSION['message'] = "VOTRE COMMANDE A ETE ENREGISTREE AVEC SUCCES";
    $_SESSION['cart'] = [];
    header('Location: '.$app_url.'index.php');
}else{
    $_SESSION['message'] = "ECHEC DE L'ENREGISTREMENT DE LA COMMANDE";

    header('Location: '.$app_url.'client/panier/panier.php');
}




