<?php
header("Content-Type:application/json");

require_once('../../Services/CardService.php');
require_once('../../Objects/Card.php');
$request = json_decode(file_get_contents('php://input'));

$method = $request->method;
$apikey = $request->apikey;
$token = $request->token; 

switch ($method) {

    case 'getCards':
        $idList = $request->idList;
        $cardService = new CardService(new Card('','',''));
        $arrayCards = array();
        $arrayCards = $cardService->getCards($idList,$apikey,$token);
        response(200,$method,$arrayCards);
    break;

    case 'create':
        $idList = $request->idList;
        $name = $method = $request->name;
        $desc = $request->desc;
        $card = new Card($name,'',$idList);
        $card->desc = $desc;
        $cardService = new CardService($card);
        //Crear tarjeta en Trello
        $card = $cardService->createCard($apikey,$token);
        response(200,$method,$card);
    break;

    case 'update': 
        $id  = $request->id;
        $name = $request->name;
        $desc = $request->desc;
        $idList = $request->idList;
        $card = new Card($name,$id, $idList);
        $card->setDesc($desc);
        $cardService = new CardService($card);
        //Editar tarjeta en Trello
        $card = $cardService->updateCard($card,$apikey,$token);
        response(200,$method,$card);
    break;

    case 'delete':
        $id  = $request->id;
        $card = new Card('',$id,'');
        $cardService = new CardService($card);
        //Editar tarjeta en Trello
        $card = $cardService->deleteCard($card,$apikey,$token);
        response(200,$method,$card);
    break;
}
function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	$json_response = json_encode($response);
	echo $json_response;
}

?>
