var app = angular.module('M4POrderProcess');

app.controller('SelectStyle', ['$rootScope', '$scope',
function ($rootScope, $scope) {
	$scope.orderProcessSlideNum = 1;

	$scope.changeSlide = function($num){
		$scope.orderProcessSlideNum = $num;
		$scope.apply();
	}
}
]);