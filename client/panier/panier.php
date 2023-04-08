<?php session_start();

if(!isset($_SESSION['cart'])){
   $_SESSION['cart'] = [];
}

   include("../../config.php");

   include("../../fonctions.php");

   $listProducts = [];
   $no_products = 0;
	$clientParam = ["limit" => 10, "sortfield" => "datec"];
	$productsResult = CallAPI("GET", $apiKey, $apiUrl."products", $clientParam);

	$productsResult = json_decode($productsResult, true); 

	if (isset($productsResult["error"])) {
      if($productsResult["error"]["code"] != "404"){
         die("une erreur est survenue");
      }else{
         $no_products = 1;
      }  
	}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Oxfam Informatique</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="../css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <!-- fonts -->

      <style>
        .liens-ox{
            color: black !important;
        }
      </style>
   </head>
   <body>
      
   <?php 
    include '../includes/header.php';
   ?>
      
      <!-- product section start -->
      <div class="product_section">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h1 class="product_taital">Votre panier</h1>
                  <!-- <p class="product_text">incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> -->
               </div>
            </div>
            <div class="product_section_2 layout_padding">
               <div class="row">

                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Noms</th>
                            <th scope="col">Description</th>
                            <th scope="col">prix</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                        $total = 0;
                        if($no_products == 1){
                            echo "<h1>Aucun produit disponible</h1>";
                        }else{
                            foreach ($_SESSION['cart'] as $id_produit) { 
                              $produit = get_produit($id_produit);
                              //var_dump($id_produit); die();
                              $total += $produit["price"]; ?>
                                    <tr>
                                    <td><img src="<?= $app_url."admin/img/uploads/".$produit["url"] ?>" style="width: 40px;height: 40px;"></td>
                                    <td><?= $produit["label"] ?></td>
                                    <td><?= $produit["description"] ?></td>
                                    <td><?= round($produit["price"], 2) ?>$</td>
                                    <td> <a class="btn" href="<?=$app_url?>client/panier/retirer-du-panier.php?id_produit=<?= $produit['id'] ?>">Retirer du panier</a> </td>
                                    </tr>                            
                        <?php } 
                        }
                    ?>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col" class="float-right">Total TTC :</th>
                            <th scope="col"><?= round($total, 2) ?>$</th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"><a href="<?= $app_url ?>client/traitements/enregistrer_commande.php" class="btn btn-primary">Commander</a> </th>
                        </tr>
                    <tbody>
                </table>
                  
               </div>
            </div>
         </div>
      </div>
      <!-- product section end -->


      <?php if(isset($_SESSION['message'])){ ?>
         <script>
            alert("<?= $_SESSION['message'] ?>")
         </script>

         <?php 
         unset($_SESSION['message']);
      } ?>


      <?php 
        include '../includes/footer.php';
      ?>
   </body>
</html>