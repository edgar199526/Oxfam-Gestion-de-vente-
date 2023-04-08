<?php session_start();
include("../../config.php");
include("../../fonctions.php");


$target_dir = "../img/uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


if ($_FILES["image"]["size"] > 600000) {
    echo "L'image que vous avez choisi est trop lourde. ";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG" ) {
    echo "type Image invalide ";
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    echo "Echec de l'importatin de l'image";
} else {
    $image_destination = "upload-".time().".".$imageFileType;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image_destination)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        
        $produit = array(
            'ref' => time(),
            'name' => $_POST['nom'],
            'label' => $_POST['nom'],
            'description' => $_POST['description'],
            'status' => 1,
            'status_buy' => 1,
            'price' => $_POST['prix'],
            'image_url' => $image_destination,
            'url' => $image_destination,
            'desiredstock' => 50,
            'stock' => 20
        );
        
        $result = CallAPI("POST", $apiKey, $apiUrl."products", json_encode($produit));        

        header('Location: '.$app_url."admin/produits.php");

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}





