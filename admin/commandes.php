<?php session_start();

    include("../config.php");

    if(!isset($_SESSION['is_admin'])){
        header('Location: '.$app_url."admin/index.php");
    }

    include("../fonctions.php");


    $no_commands = 0;
	$commandsResult = CallAPI("GET", $apiKey, $apiUrl."orders");

	$commandsResult = json_decode($commandsResult, true); 

	if (isset($commandsResult["error"])) {
        if($commandsResult["error"]["code"] != "404"){
           die("une erreur est survenue");
        }else{
           $no_commands = 1;
        }  
    }

    // var_dump($commandsResult);


?>
<!DOCTYPE html>
<html lang="fr">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Admin</title>
		<meta name="description" content="">

		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>

    <body>
        <div id="wrapper">

        <?php 
            include 'includes/aside.php';
        ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <center><h2>Dashboard</h2></center>
                    
                    <?php include("includes/header.php"); ?>

                </nav>

                <div class="container-fluid">
                    
                        <h1 class=" h3 mb-2 text-gray-800">Commandes</h1>
                        
                                
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                        <div id="resultats_recherche" class="col col-12"></div>
                            <div class="table-responsive"> 

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th scope="col">Ref.</th>
                                        <th scope="col">Tiers</th>
                                        <th scope="col">Date commande</th>
                                        <th scope="col">Montant HT</th>
                                        <th scope="col">Facturé</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php 
                                    if($no_commands == 1){
                                        echo "<tr colspan=6>Aucune commande</tr>";
                                    }else{

                                        foreach ($commandsResult as $commande) {
                                        ?>
                                            <tr>
                                                <th scope="row"><?= $commande["ref"] ?></th>
                                                <td><?= $commande["socid"] ?></td>
                                                <td><?= $commande["date"] ?></td>
                                                <td><?= $commande["total_ht"] ?></td>
                                                <td>Non</td>
                                                <td class="text-center">
                                                    <a data-toggle="modal" data-target="#modalCommande<?= $commande["id"] ?>" href="#" id="button_" class="btn btn-success btn-sm">
                                                       Détails
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php }} ?>
                                    
                                        
                                    </tbody>
                
                                </table>


                                <?php
                                foreach ($commandsResult as $commande) {
                                ?>
                                                    <!-- modal pour banir un client -->
                                    <div class="modal fade" id="modalCommande<?= $commande["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    
                                                        <h4 style="width: 100%;">
                                                            <center>
                                                                Détails - commande Réf : <?= $commande["ref"] ?>
                                                                
                                                            </center>
                                                        </h4>
                                                    
                                                    <button id="closemodalBanirClient" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    

                                                <div class="form-group">
                                                    <label for="nom" class="col-form-label">Nom du Client (Tiers) : </label>
                                                    <b><?= get_client($commande["socid"])["name"] ?></b>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nom" class="col-form-label">Produits : </label> <br>
                                                    <?php $compt = 1;

                                                        foreach($commande["lines"] as $produit){  ?>
                                                            <?= $compt ?> - <?= $produit['libelle'] ?> <br>
                                                        <?php } $compt ++; ?>
                                                    
                                                </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    }
                                ?>



                                <div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


                                    <div class="modal fade" id="modalAjouterProduit" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    
                                                        <h4 style="width: 100%;">
                                                            <center>
                                                                Ajoutez un nouveau produit
                                                            </center>
                                                        </h4>
                                                    
                                                    <button id="closemodalBanirClient" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                <form class="row" method="post" action="traitements/ajoutProduit.php" enctype="multipart/form-data">

                                                    <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="nom" class="col-form-label">nom du produit</label>
                                                        <input type="text" class="form-control" id="nom" name="nom">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="col-form-label">Description</label> <br>
                                                        <textarea name="description" id="" cols="50" rows="5"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prix" class="col-form-label">Prix:</label>
                                                        <input type="text" class="form-control" id="prix" name="prix">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="image" class="col-form-label">image</label>
                                                        <input type="file" class="form-control" id="image" name="image">
                                                    </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-outline-success btn-sm btn-block mb-10">Enregistrer</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>

                                                </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                  
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Admin 2023</span>
                    </div>
                </div>
            </footer>

        </div>
        </div>

        <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
        </a>

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>


        </body>
</html>
