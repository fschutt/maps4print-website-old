var app = angular.module('M4POrderProcess');

/*DISPLAY LIST OF ORDERED MAPS*/
app.factory("orderProcessService", ['leafletDisplayMapService', function (leafletDisplayMapService) {
    var privateMapList = [];
    var currentPOIMarkers = [];
    var currentGPXTrackJSONPoints = [];

    return {
      getAllMaps: function () {
        return [].concat(privateMapList);
      },
      addMap: function (mapName, width, height) {
        //We actually don't need the scale at all, it just confuses the user
        var mapCoords = leafletDisplayMapService.getNewMapCoordinates(width, height);

        //Determine ID of the new map, one more than the biggest ID we have right now
        var id = 0;
        for (var i = privateMapList.length - 1; i >= 0; i--) {
          if(privateMapList[i].id > id){
            id = privateMapList[i].id;
          }
        }
        id += 1;

        //Define map
        var currentMap = {
                    id: id,
                    mapName: mapName,
                    width: width,
                    height: height,
                    north: mapCoords.north,
                    east: mapCoords.east,
                    south: mapCoords.south,
                    west: mapCoords.west,
                    active: false };   

        privateMapList.push(currentMap);
        leafletDisplayMapService.addRectangleMap(currentMap);
      },
      removeMap: function(id){
      	leafletDisplayMapService.removeRectangleMap(privateMapList[id].id);
        privateMapList.splice(id, 1);
      },
      setActiveMap: function (id) {
        privateMapList[id].active = true;
      },
      zoomToMap: function(id){
        leafletDisplayMapService.zoomToBBox(privateMapList[id].north, 
                                            privateMapList[id].south,
                                            privateMapList[id].east,
                                            privateMapList[id].west);
      }
    };
}]);

app.controller('formCtrl', function($scope, orderProcessService) {
  var initWidth = 297;
  var initHeight = 210;
  orderProcessService.addMap("", initWidth, initHeight);

  $scope.addMap = function() {
    orderProcessService.addMap($scope.mapName, initWidth, initHeight);
    $scope.mapName = $scope.scale = $scope.width = $scope.height = "";
  };
});

app.controller('mapListCtrl', function($scope, orderProcessService) {
  $scope.maps = orderProcessService.getAllMaps;
  $scope.removeMap = function (id) {
  	orderProcessService.removeMap(id);
  };
});