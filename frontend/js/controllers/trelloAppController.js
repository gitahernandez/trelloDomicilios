trelloApp.controller('trelloAppController', function($scope, $sce, $q, $http,trelloAppService){

$scope.boards = [];
$scope.lists = [];
$scope.cards = [];
$scope.labelBoton = "Crear Tarea";
$scope.url  = "http://localhost/trello/backend/Rest";

$scope.mostrarFormulario = false;

$scope.cardEdit = {};

$scope.formNote ={
	id:"",
	method:"create",
	name:"",
	desc:"",
	idList:""
}

$scope.token = "";
$scope.errorToken = false;
$scope.validoToken = false;
$scope.mostrarLoading = false;
$scope.apikey = "794a55f67152e8b27646ad12a18557e0";


$scope.getInfoBoards = function(){	
	$scope.dataGetBoardas = {};
	$scope.dataGetBoardas.config = {};

	$scope.dataGetBoardas.config.apikey = $scope.apikey
	$scope.dataGetBoardas.config.token = $scope.token;
	$scope.dataGetBoardas.config.method  = "getInfoBoards";
     trelloAppService.getInfoBoards($scope.url,$scope.dataGetBoardas.config).then(function(rta){
                    $scope.boards = rta.data; 
					$scope.getLists(0);
					$scope.boardSelected = $scope.boards[0];
					$scope.getCards($scope.boardSelected.lists[0].id);

    });
				
} 

$scope.getLists = function(indexTablero){	
		 angular.forEach($scope.boards,function(board,index){
			 	board.class = "";
			 
		 });

		 $scope.boardSelected = $scope.boards[indexTablero];
		 $scope.boards[indexTablero].class = 'active';
		 $scope.formNote.idList = $scope.boardSelected.lists[0].id;
		 $scope.mostrarFormulario = true;
		 $scope.boardSelected.lists[0].class = 'active';
		 $scope.getCards($scope.boardSelected.lists[0].id);
		$scope.labelBoton = "Crear";

} 

$scope.createCard = function(){
	$scope.formNote.token = $scope.token;
	$scope.formNote.apikey = $scope.apikey;
	if($scope.flagEditar){
			$scope.flagEditar = false;
			$scope.mostrarFormulario = true;
			$scope.formNote.id =$scope.cardEdit.id;
			$scope.formNote.method ="update";
			$scope.labelBoton = "Crear Tarea";
			
	
	}

	else{
		$scope.formNote.method = 'create';
		$scope.mostrarFormulario = true;
	}
		console.log($scope.formNote);
		trelloAppService.adminNotes($scope.url,$scope.formNote).then(function(rta){
					$scope.getCards($scope.formNote.idList);

					$scope.formNote ={
						id:"",
						method:"create",
						name:"",
						desc:"",
						idList:""
					}
			 $scope.formNote.idList = $scope.boardSelected.lists[0].id;
		});
	
}


$scope.getCards = function(idList){
	$scope.formNote.token = $scope.token;
	$scope.formNote.apikey = $scope.apikey;
	$scope.formNote.method = 'getCards';
	$scope.formNote.idList = idList;
	 trelloAppService.adminNotes($scope.url,$scope.formNote).then(function(rta){
                 $scope.cards = rta.data;
				 		$scope.formNote ={
						id:"",
						method:"create",
						name:"",
						desc:"",
						idList:""
					}
			 $scope.formNote.idList = idList;
    });

}

$scope.getCardsWithClass = function(indexLista){

	$scope.listSelect =  $scope.boardSelected.lists[indexLista];
	angular.forEach($scope.boardSelected.lists,function(list,index){
			 	list.class = "";
	});
	$scope.boardSelected.lists[indexLista].class = 'active';
	$scope.getCards($scope.boardSelected.lists[indexLista].id);
	
}




$scope.deleteCard = function(idCard, index){
	$scope.formNote.token = $scope.token;
	$scope.formNote.apikey = $scope.apikey;
	$scope.formNote.method = 'delete';
	$scope.formNote.id = idCard;
	$scope.cards.splice(index,1);
	 trelloAppService.adminNotes($scope.url,$scope.formNote).then(function(rta){
    });
}

$scope.viewCard = function(card){
		$scope.mostrarFormulario = true;
	
	console.log("Card a Editar");
	console.log(card);
	$scope.cardEdit = card;
	$scope.flagEditar = true;
	$scope.labelBoton = "Editar";
	$scope.formNote ={
		id:card.id,
		method:"update",
		name:card.name,
		desc:card.desc,
		idList:card.idList
	}

}


$scope.verifyToken = function(){
	if($scope.token.trim() == ""){
		$scope.errorIngresoToken = true;
		return;
	}
	else{
		$scope.errorIngresoToken = false;
	}
	$scope.mostrarLoading = true;
	trelloAppService.verifyToken($scope.url,$scope.apikey,$scope.token).then(function(data){
		$scope.mostrarLoading = false;
		$scope.objVerificarToken = data;
		if($scope.objVerificarToken.codigo == 1) {
				$scope.errorToken = true;
				$scope.validoToken = false;
		}
		else{
			$scope.errorToken = false;
			$scope.validoToken = true;
			$scope.infoUser = data.infoUser;
			$scope.getInfoBoards();

		}

	});

}



});
