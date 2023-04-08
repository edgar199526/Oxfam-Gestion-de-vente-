<?php session_start();

if(!isset($_SESSION['cart'])){
   $_SESSION['cart'] = [];
}

   include("config.php");

   include("fonctions.php");

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
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
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
    include 'client/includes/header.php';
   ?>
      
      <!-- product section start -->
      <div class="product_section">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h1 class="product_taital">Boutique</h1>
                  <!-- <p class="product_text">incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> -->
               </div>
            </div>
            <div class="product_section_2 layout_padding">
               <div class="row">

               <?php 
                  if($no_products == 1){
                     echo "<h1>Aucun produit disponible</h1>";
                  }else{
                     foreach ($productsResult as $produit) { ?>

                        <div class="col-lg-3 col-sm-6">
                           <div class="product_box">
                              <h4 class="bursh_text"><?= $produit["label"] ?></h4>
                              <p class="lorem_text"><?= $produit["description"] ?></p>
                              <img src="<?= $app_url."admin/img/uploads/".$produit["url"] ?>" class="image_1" style="max-width: 254px;">
                              <div class="btn_main">
                                 <div class="buy_bt">
                                    <ul>
                                       <li><a href="#">Voir</a></li>
                                       <li><a title="Ajouter au panier" href="<?= isset($_SESSION['id_client']) ? $app_url.'client/panier/ajouter-au-panier.php?id_produit'.$produit['id'] : '#' ?>">
                                       <img src="client/images/cart2.png" style="width: 20px;height: 20px;">
                                       </a></li>
                                    </ul>
                                 </div>
                                 <h3 class="price_text"><?= round($produit["price"], 2) ?>$</h3>
                              </div>
                           </div>
                        </div>
                  <?php } 
                  }
               ?>
                  
               </div>
               <div class="seemore_bt"><a href="#">See More</a></div>
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
        include 'client/includes/footer.php';
        include 'client/includes/inscription.php';
      ?>
   </body>
</html>