<?php 


function get_produit($ref){
    
    include("config.php");
    
    $productsResult = CallAPI("GET", $apiKey, $apiUrl."products/".$ref);
    $productsResult = json_decode($productsResult, true); 

    return $productsResult;
 
}


function get_client($id_client){
    include("config.php");
    
    $productsResult = CallAPI("GET", $apiKey, $apiUrl."thirdparties/".$id_client);
    $productsResult = json_decode($productsResult, true); 

    return $productsResult;
}



function get_nbre_elements($elements){
    
    include("config.php");
    
	$Result = CallAPI("GET", $apiKey, $apiUrl.$elements);

	$Result = json_decode($Result, true);

	if (isset($Result["error"]) && $Result["error"]["code"] >= "300") {
        return 0;
	} else {
		return sizeof($Result);
	}
}

function CallAPI($method, $apikey, $url, $data = false)
{
    $curl = curl_init();
    $httpheader = ['DOLAPIKEY: '.$apikey];

    switch ($method)
    {
        case "POST":
           curl_setopt($curl, CURLOPT_POST, 1);
            $httpheader[] = "Content-Type:application/json";

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            break;
        case "PUT":

	    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            $httpheader[] = "Content-Type:application/json";

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            break;

        case "DELETE":

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            $httpheader[] = "Content-Type:application/json";

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            break;

        default:

            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    //die($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    $result = curl_exec($curl);

    curl_close($curl);	 

    return $result;
}