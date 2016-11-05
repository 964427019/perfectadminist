var app = angular.module('myApp',[]);

app.controller('myCtrlRegistro',  function($scope,$http,$window) {
	
	$scope.usuario = {Nombre:'', Facebook:'', Celular:'', Operador:'', Distrito:'', Precio:''};
	$scope.distritos = [
						'AREQUIPA',
						'ALTO SELVA ALEGRE',
						'CAYMA',
						'CERRO COLORADO',
						'CHARACATO',
						'CHIGUATA',
						'JACOBO HUNTER',
						'LA JOYA',
						'MARIANO MELGAR',
						'MIRAFLORES',
						'MOLLEBAYA',
						'PAUCARPATA',
						'POCSI',
						'POLOBAYA',
						'QUEQUEÑA',
						'SABANDIA',
						'SACHACA',
						'SAN JUAN DE SIGUAS',
						'SAN JUAN DE TARUCANI',
						'SANTA ISABEL DE SIGUAS',
						'SANTA RITA DE SIGUAS',
						'SOCABAYA',
						'TIABAYA',
						'UCHUMAYO',
						'VITOR',
						'YANAHUARA',
						'YARABAMBA',
						'YURA',
						'JOSE LUIS BUSTAMANTE Y RIVERO'
	];
	$scope.operadores = [
						'BITEL',
						'CLARO',
						'ENTEL',
						'MOVISTAR',
						'OTROS'
	];

	$scope.registrar = function() {

		$http({
		    method: 'GET',
		    url: 'server/registro.php',
		    params:{ nuevoUsuario: JSON.stringify($scope.usuario)}
    	}).success(function(response){
    		
    		if(response == 1){
    			alert("Se registro exitosamente");
    			window.location.href="index.html";
    		}
    		else{
    			alert("Error de registro");
    		}
    	});
	};

});


