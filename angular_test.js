	var app = angular.module('MysqlTransporte', ['ui.bootstrap']);
	app.controller('MysqlCtrl', function($scope, $http) {
		$scope.currentPage = 1;
		$scope.selectedProcs = [];
		$scope.EscogerRutina = function(proc) {
			if ($scope.selectedProcs.indexOf(proc) < 0) {
				try {
					$scope.selectedProcs.push(proc);
				} catch (exc) {}
			}

		};

		$scope.RemoverProc = function(proc) {
			var indice = $scope.selectedProcs.indexOf(proc);

			$scope.selectedProcs.splice(indice, 1);
		};


		$scope.maxSize = 10;
		$http.get('backend/web/index.php/servidoresbd').then(function(response) {
			$scope.servers = response.data.data;
			$scope.procedures = [];
		});

		$scope.pageChanged = function() {

			$scope.SelecciondbChange();
		};
		$scope.SeleccionServerSource = function() {

			$http.get('backend/web/index.php/proc/listadodb?serverid=' + $scope.dbServerSource).then(function(response) {
				$scope.$parent.procedures = [];
				$scope.datos = response.data.data;
			});
		}
		$scope.SelecciondbChange = function() {

			var url = 'backend/web/index.php/proc/list?serverid='.concat($scope.dbServerSource.trim()).concat('&db=').concat($scope.dbSeleccionada.trim()).concat('&nombre_proc=');


			url = url.concat("&page=").concat($scope.currentPage);
			url = url.concat("&pageSize=10");
			$http.get(url).then(function(response) {

				$scope.procedures = response.data.data;
				$scope.$parent.procedures = $scope.procedures;
				$scope.$parent.currentPage = response.data._meta.currentPage;

				$scope.$parent.totalItems = response.data._meta.totalCount;

			});

		};

	});