<?php session_start();
include("../../config.php");
include("../../fonctions.php");

$nomComplet = $_POST["nom"];
$num = $_POST["telephone"];
$mail = $_POST["email"];
$address = $_POST["adresse"];
$cp = $_POST["cp"];
$ville = $_POST["ville"];
$telephone =$_POST["telephone"];

$newClient = [
    "name" 			=> $nomComplet,
    "email"			=> $mail,
    "address"	    => $address,
    "zip"  	        => $cp,
    "town" 		    => $ville,
    "phone"         => $telephone,
    "password"      => $_POST["password"],
    "client" 		=> "1", // 1 : correspond statue client
    "code_client"   => "-1" // -1 : gererer automatiquement un code client  
];

$newClientResult = CallAPI("POST", $apiKey, $apiUrl."thirdparties", json_encode($newClient)); 

$newClientResult = json_decode($newClientResult, true);

if(is_numeric($newClientResult)){

    $_SESSION["id_client"] = $newClientResult;
    $_SESSION['message'] = "VOTRE INSCRIPTION A ETE FAITE AVEC SUCCES";

}else{
    $_SESSION['message'] = "ECHEC DE L'INSCRIPTION.";
}

header('Location: '.$app_url."index.php");