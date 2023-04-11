<?php session_start();
include("../../config.php");
include("../../fonctions.php");

        $produit = array(
            'id' => $_POST['id']
        );
        $method = "\DELETE";
        
        $result = CallAPI("DELETE", $apiKey, $apiUrl."products/".$_POST['id']);

        $result = json_decode($result, true);

        $_SESSION['message'] = "Produit supprimé avec succès";

        if (isset($result["error"]) && $result["error"]["code"] == "409") {
            $_SESSION['message'] = "Impossible de supprimer ce produit car il est utilisé dans la commande d'un client";
        }else if(isset($result["error"])){
            $_SESSION['message'] = $result["error"];
        }

        header('Location: '.$app_url."admin/produits.php");

    