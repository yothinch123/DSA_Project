var app = angular.module("myApp", []);
app.controller("employeeCtrl", function ($scope, $http) {
	$scope.fetchData = function () {
		$http({
			method: "POST",
			url: "Employee/getEmployeeBy",
		}).then(function (response) {
			$scope.datas = response.data;
		});
	};
});
