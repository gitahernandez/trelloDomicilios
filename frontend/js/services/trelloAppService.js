trelloApp.factory('trelloAppService', function ($http, $q){

        // Obtener los tableros y las listas de cada tablero
        function getInfoBoards(server,$obj) {

            var deferred = $q.defer();
            var req = {
                method: 'POST',
                url:  server+"/Board/?method=getInfoBoards",
                data:$obj,
                headers: {'Content-Type': 'application/json'}
            };
            $http(req)
                .success(function (data) {
                    deferred.resolve(data)
                })
                .error(function (error, status){
                    var obj = {}
                    obj.codigo = 1;
                    deferred.resolve(obj);
                }); 
            
            return deferred.promise;
        };


        // guardar,editar,borraro listar tarea
        function adminNotes(server,info) {
            var method = "POST";
            if(info.method == "update"){
                method = "PUT";
            }
            var deferred = $q.defer();
            var req = {
                method: method,
                url:  server+"/Card/",
                data: info,
                headers: {'Content-Type': 'application/json'}
            };
            $http(req)
                .success(function (data) {
                    deferred.resolve(data)
                })
                .error(function (error, status){
                    var obj = {}
                    obj.codigo = 1;
                    deferred.resolve(obj);
                }); 
            
            return deferred.promise;
        };


        function verifyToken(server,apikey,token){
            var obj = {};
            obj.apikey = apikey;
            obj.token = token;
            var deferred = $q.defer();
            var req = {
                method: 'POST',
                url:  server+'/Member/',
                data: obj,
                headers: {'Content-Type': 'application/json'}
            };
            $http(req)
                .success(function (data) {
                    deferred.resolve(data)
                })
                .error(function (error, status){
                    var obj = {}
                    obj.codigo = 1;
                    deferred.resolve(obj);
                }); 
            
            return deferred.promise;

        }

        return {
            getInfoBoards: getInfoBoards,
            adminNotes: adminNotes,
            verifyToken:verifyToken
        };
    
    });