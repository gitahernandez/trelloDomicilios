<?php
/*
*OBJETIVO: Board Service
*AUTOR:Andrés Felipe Hernández Rocha
*FECHA CREACION:08/04/2018
*/

class BoardService{
var $board;
var $boards = array();

  
function getBoards($apikey,$token){
    $boards = json_decode(file_get_contents('https://api.trello.com/1/members/me/boards?key='.$apikey.'&token='.$token),true);
    $boardsArray = array();
    foreach ($boards as $obj){
        $board = new Board();
        $board->setName($obj['name']);
        $board->setId($obj['id']); 
        $board->setObjectResponseTrello($obj);
        
        $lists = json_decode(file_get_contents('https://api.trello.com/1/boards/'.$board->getId().'/lists?key='.$apikey.'&token='.$token),true);
        $listasArray = array();
        foreach ($lists as $obj){
              $list = new Listt($obj['id'],$obj['name']);
              $list->setObjectResponseTrello($obj);
              array_push($listasArray,$list);
              
          }
          $board->setList($listasArray);
          array_push($boardsArray,$board);
      }

      return $boardsArray;
      

    }

}

?>