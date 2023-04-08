
<div class="header_section">
         <div class="container-fluid">
            <nav class="navbar navbar-light bg-light justify-content-between">
               <a href="<?= $app_url.'index.php' ?>">Oxfam Informatique</a>
               <form class="form-inline ">
                  <div class="login_text">
                     <ul>
                     <?php 

                     if(isset($_SESSION['id_client'])){ ?>

                        <li><a href="<?= $app_url."index.php" ?>" class="liens-ox">Boutique |</a></li>
                        <li><a href="#" class="liens-ox" >| Demande de devis</a></li>
                        <li><a href="<?=$app_url?>client/panier/panier.php" class="liens-ox">
                           <img src="<?=$app_url?>client/images/cart.png" style="width: 40px;height: 40px; border-radius: 5px"><?= sizeof($_SESSION['cart']) ?></a>
                        </li>


                     <?php }else{ ?>

                        <li><a href="#" class="liens-ox" data-toggle="modal" data-target="#connexionModal">Connexion</a></li>
                        <li><a href="#" class="liens-ox" data-toggle="modal" data-target="#inscriptionModal">inscription</a></li>
                        <li><a href="<?= $app_url."index.php" ?>" class="liens-ox">boutique</a></li>  

                     <?php } ?>

                     </ul>
                     </div>
                  </form>
               </nav>
            </div>
         </div>
