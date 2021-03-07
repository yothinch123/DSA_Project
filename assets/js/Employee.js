var app = angular.module('myApp', []);
app.controller('employeeCtrl', function ($scope, $http) {
  $scope.fetchData = function () {
    $http({
      method: "POST",
      url: "index.php/EmployeeController/getEmployeeBy",
    }).then(function (response) {
      $scope.datas = response.data;
    });
  }
});