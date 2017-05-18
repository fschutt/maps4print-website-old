var app = angular.module("customerBackend", []);

app.controller("customerOrderTable", function($scope, $http) {
  $http.get("php/crm/functions/get_customer_orders.php")
    .then(function(response) {
      $scope.shopping_carts = response.data;
    });
});