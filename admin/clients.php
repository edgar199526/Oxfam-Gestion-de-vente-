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

    //var_dump($listClientResult);
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

                    <h1 class="h3 mb-2 text-gray-800">Clients</h1>
                                
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                        <div id="resultats_recherche" class="col col-12"></div>
                            <div class="table-responsive"> 

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Noms</th>
                                        <th scope="col">Adresse</th>
                                        <th scope="col">Code postal</th>
                                        <th scope="col">Ville</th>
                                        <th scope="col">Email</th>
                                        </tr>
                                    </thead>

                                    <tbody id="liste_clients">

                                    <?php 
                                    foreach($listClientResult as $key=>$client){
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $client["id"] ?></th>
                                            <td><?= $client["name"] ?></td>
                                            <td><?= $client["address"] ?></td>
                                            <td><?= $client["zip"] ?></td>
                                            <td><?= $client["town"] ?></td>
                                            <td><?= $client["email"] ?></td>
                                            
                                        </tr>
                                    <?php } ?>
                                        
                                    </tbody>
                
                                </table>


                              



                                <div>
                                    
                                </div>
                            </div>
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
