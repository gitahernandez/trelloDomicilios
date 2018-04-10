<?php
/*
*OBJETIVO: Member Service
*AUTOR:Andrés Felipe Hernández Rocha
*FECHA CREACION:09/04/2018
*/
class MemberService{

function getMember($apikey,$token){
        $contexto = urldecode("key=".$apikey."&token=".$token);
        $url = 'https://api.trello.com/1/members/me/?'.$contexto;
        $member =  json_decode(file_get_contents($url),true);
        return $member;
    }

}

?>