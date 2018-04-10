<?php
/*
*OBJETIVO: DTO List
*AUTOR:Andrés Felipe Hernández Rocha
*FECHA CREACION:08/04/2018
*/
require_once('Card.php');
class Listt{
    var $name;
    var $id;
    var $cards;
    var $idList;
    var $objectResponseTrello;

    function __construct($id,$name){
        $this->id = $id;
        $this->name = $name;
      }

    function setName($name)
    {
        $this->name = $name;
    }

    function getname($name)
    {
        return $this->name;
    }
    function getId($id)
    {
        return $this->id;
    }
    function setId($id)
    {
        $this->id = $id;
    }
 
    function pushCard($card)
    {
        array_push($this->cards,$card);
    }
    function getObjectResponseTrello()
    {
        return $this->objectResponseTrello;
    }
    function setObjectResponseTrello($objectResponseTrello)
    {
        $this->objectResponseTrello = $objectResponseTrello;
    }
}
?>
