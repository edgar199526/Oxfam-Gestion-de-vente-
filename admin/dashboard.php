<?php session_start();

include("../config.php");

if(!isset($_SESSION['is_admin'])){
    header('Location: '.$app_url."admin/index.php");
}

include("../fonctions.php");

    $listClients = [];
	$clientParam = ["limit" => 10, "sortfield" => "datec"];
	$listClientResult = CallAPI("GET", $apiKey, $apiUrl."thirdparties", $clientParam);

	$listClientResult = json_decode($listClientResult, true);

    

	if (isset($listClientResult["error"]) && $listClientResult["error"]["code"] >= "300") {
	} else {
		foreach ($listClientResult as $client) {
			$listClients[intval($client["id"])] = html_entity_decode($client["ref"], ENT_QUOTES);
			
		}
	}

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

                <div class="row">

                    <!-- CA Jour -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="#" class="link">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nombre de clients</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                <?= get_nbre_elements('thirdparties') ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-euro-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- CA Mois -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nombre de produits</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            
                                            <?= get_nbre_elements("products") ?>

                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-euro-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Nouveaux clients jour -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nombre de commandes</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            
                                            <?= get_nbre_elements("orders") ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>


                <div>
                                    
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
