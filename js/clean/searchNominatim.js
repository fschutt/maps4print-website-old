var app = angular.module('M4POrderProcess');

/*SEARCH SERVICE AND CONTROLLER*/
app.factory("nominatimSearchService", ['$http', function ($http) {
    var results = [];
    return {
      //function for getting data from nominatim
      getInfo: function (query) {
      	var url = 'http://open.mapquestapi.com/nominatim/v1/search.php?key=w0071imhmuAcNYecGDrzwXNbwxNJPwZf&format=json';
      	var safeQuery = query.replace(/<(?:.|\n)*?>/gm, '');
      	var queryUrl = url += "&q=" + safeQuery + "&limit=3";

      	$http.get(queryUrl).then(
      		//success
      		function (response) { results = response.data; },
      		//error
      		function (response) {}
      	);
      },
      getAllMaps: function () {
        return [].concat(results);
      },
      getMap: function (id) {
        return [].concat(results[id]);
      }
    };
}]);

app.controller('searchCtrl', ['$scope', 'nominatimSearchService', 'leafletDisplayMapService', 
function($scope, nominatimSearchService, leafletDisplayMapService) {
  $scope.getInfo = function() {
  	nominatimSearchService.getInfo($scope.queryStr);
  };
}]);

app.controller('listSearchResultsCtrl', function($scope, nominatimSearchService) {
  $scope.searchResults = nominatimSearchService.getAllMaps;

  //zoom map to search result extents
  $scope.zoomToSearchResult = function (id) {
  	var mapInfo = nominatimSearchService.getMap(id);
    leafletDisplayMapService.changeBBox(mapInfo.north, mapInfo.east, mapInfo.south, mapInfo.west);
  }
});