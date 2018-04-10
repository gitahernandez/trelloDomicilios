<?php
/*
*OBJETIVO: DTO Card
*AUTOR:Andrés Felipe Hernández Rocha
*FECHA CREACION:08/04/2018
*/
class Card{
    var $name;
    var $id;
    var $desc;
    var $shortLink;
    var $idList;
    var $objectResponseTrello;

    function __construct($name,$id,$idList){
        $this->name = $name;
        $this->id = $id;
        $this->idList = $idList;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function getname()
    {
        return $this->name;
    }
    function setDesc($desc)
    {
        $this->desc = $desc;
    }

    function getDesc()
    {
        return $this->desc;
    }
    function getId()
    {
        return $this->id;
    }
    function setId($id)
    {
        $this->id = $id;
    }
    function getObjectResponseTrello()
    {
        return $this->objectResponseTrello;
    }
    function setObjectResponseTrello($objectResponseTrello)
    {
        $this->objectResponseTrello = $objectResponseTrello;
    }

    function getShortLink()
    {
        return $this->shortLink;
    }
    function setShortLink($shortLink)
    {
        $this->shortLink = $shortLink;
    }

    function getIdList()
    {
        return $this->idList;
    }
    function setIdList($idList)
    {
        $this->idList = $idList;
    }

}
?>