<?php
header("Content-Type:application/json");
require_once('../../Objects/List.php');
require_once('../../Objects/Board.php');
require_once('../../Services/BoardService.php');

$request = json_decode(file_get_contents('php://input'));

$method = $request->method;
$apikey = $request->apikey;
$token = $request->token;

switch ($method) {
    case 'getInfoBoards':
    $boards = array();
    $boardService = new BoardService();
    $boards = $boardService->getBoards($apikey,$token);
    response(200,$method,$boards);
    break;
}
function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);	
	$response['status']=$status;
	$response['status_message']=$status_message." OK";
	$response['data']=$data;
	$json_response = json_encode($response);
	echo $json_response;
}
?>
