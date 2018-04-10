<?php
/*
*OBJETIVO: DTO Board
*AUTOR:Andrés Felipe Hernández Rocha
*FECHA CREACION:08/04/2018
*/
require_once('List.php');
class Board{
    var $name;
    var $id;
    var $lists = array();
    var $objectResponseTrello;
    
    function setName($name)
    {
        $this->name = $name;
    }

    function getname($name)
    {
        return $this->name;
    }
    function getId()
    {
        return $this->id;
    }
    function setId($id)
    {
        $this->id = $id;
    }
    function setList($list)
    {
        $this->lists = $list;
    }
    
    function getList()
    {
        return $this->lists;
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