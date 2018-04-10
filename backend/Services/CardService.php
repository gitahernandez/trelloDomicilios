<?php
/*
*OBJETIVO: Service Card
*AUTOR:Andrés Felipe Hernández Rocha
*FECHA CREACION:08/04/2018
*/
class CardService{
    var $card;
    function __construct($card){
        $this->card = $card;
    }
 
    function getCards($idLista,$apikey,$token){
        $cards = json_decode(file_get_contents('https://api.trello.com/1/lists/'.$idLista.'/cards?key='.$apikey.'&token='.$token),true);
        $cardsArray = array();
        foreach ($cards as $obj){
            $card = new Card(null,null,null);
            $card->setName($obj['name']);
            $card->setDesc($obj['desc']);  
            $card->setId($obj['id']);
            $card->setIdList($obj['idList']);
            $card->setShortLink($obj['shortLink']); 
            $card->setObjectResponseTrello($obj); 
            array_push($cardsArray,$card);
        }
          return $cardsArray;
    }




    function createCard($apikey,$token){
        $contextTokenKey = urldecode("key=".$apikey."&token=".$token."&name=".$this->card->getName()."&desc=".$this->card->getDesc());
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $contextTokenKey
            )
        );
        $context  = stream_context_create($opts);
        $newCard = json_decode(file_get_contents('https://api.trello.com/1/lists/'.$this->card->getIdList().'/cards', false, $context));

        $this->card->setDesc($newCard->desc);  
        $this->card->setId($newCard->id); 
        $this->card->setShortLink($newCard->shortLink); 
        $this->card->setObjectResponseTrello($newCard); 
        return  $this->card;       
    } 



    function updateCard($card,$apikey,$token){
        $contextTokenKey = urldecode("key=".$apikey."&token=".$token."&name=".$card->getName()."&desc=".$card->getDesc());
        $opts = array('http' =>
            array(
                'method'  => 'PUT',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $contextTokenKey
            )
        );
        $context  = stream_context_create($opts);
        $editCard = json_decode(file_get_contents('https://api.trello.com/1/cards/'.$card->getId().'/', false, $context));

        $this->card->setDesc($editCard->desc);  
        $this->card->setId($editCard->id); 
        $this->card->setShortLink($editCard->shortLink); 
        $this->card->setObjectResponseTrello($editCard); 
        return  $this->card;       
        } 


    
        function deleteCard($card,$apikey,$token){
            $contextTokenKey = urldecode("key=".$apikey."&token=".$token."&closed=true");
            $opts = array('http' =>
                array(
                    'method'  => 'PUT',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $contextTokenKey
                )
            );
            $context  = stream_context_create($opts);
            $editCard = json_decode(file_get_contents('https://api.trello.com/1/cards/'.$card->getId().'/', false, $context));

            $this->card->setDesc($editCard->desc);  
            $this->card->setId($editCard->id); 
            $this->card->setShortLink($editCard->shortLink); 
            $this->card->setObjectResponseTrello($editCard); 
            return  $this->card;       
        } 
    
}
?>