<?php
header("Content-Type:application/json");
require_once('../../Services/MemberService.php');
$request = json_decode(file_get_contents('php://input'));

$apikey = $request->apikey;
$token = $request->token;

$memberService = new MemberService();
$member = null;
$member = $memberService->getMember($apikey,$token);
if($member == null || $member == ""){
	response(300,'Error',$member);
}
else{
	response(200,'Succes',$member);
}

function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['infoUser']=$data;
	$json_response = json_encode($response);
	echo $json_response;
}
?>
