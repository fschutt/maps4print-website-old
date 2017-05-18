//TODO: first initialize the services for GPX, markers and
//maps. then initialize one map with the default values,
//add it to the map array.

//FUNCITONS
//Add and remove map
//Add and remove point (later: add points via CSV dialog)
//Add and remove GPX track

//We change the width, height and scale automatically
//If the user changes it manually, we re-calculate the map
//from the center of the currently visible map

//This involves transforming the map cm into meters, then
//transforming them into GOOGLE EPSG, then updating the map.

//Angular
var app = angular.module('M4POrderProcess', []);

app.controller('OrderProgress', ['$rootScope', '$scope',
function ($rootScope, $scope) {
	$scope.orderProcessSlideNum = 1;

	$scope.changeSlide = function($num){
		$scope.orderProcessSlideNum = $num;
		$scope.apply();
	}
}
]);

//Suchbox und zugehöriges
app.controller('Search', ['$scope', '$http',
function ($scope, $http) {
	////Initialisierung////
		//Suchtext
		$scope.OSMSearch;
		//Suchresultate
	    $scope.OSMSearchResults = [];

	    //Asynchrone Suchfunktion
	    $scope.OSMSearchFun = function() {

			var HOST_URL = 'http://open.mapquestapi.com';
			var QUERY_URL = HOST_URL + '/nominatim/v1/search.php?key=w0071imhmuAcNYecGDrzwXNbwxNJPwZf&format=json';
			var query = $scope.OSMSearch;

			if (query != "") {
				var safeQuery = query.replace(/<(?:.|\n)*?>/gm, '');
				var safeQueryURL = QUERY_URL += "&q=" + safeQuery + "&limit=5";
				var OSM_QUERY_XHTTP = new XMLHttpRequest();

				OSM_QUERY_XHTTP.onreadystatechange = function() {
					if (OSM_QUERY_XHTTP.readyState == 4 && OSM_QUERY_XHTTP.status == 200) {
						//Query successful, build HTML
						if (OSM_QUERY_XHTTP.responseText.length != 0) {
							$scope.OSMSearchResults = JSON.parse(OSM_QUERY_XHTTP.responseText);
							$scope.$apply();
						}
					}
				};

				OSM_QUERY_XHTTP.open("GET", safeQueryURL, true);
				OSM_QUERY_XHTTP.send();

			}
		}

		$scope.zoomToBBox = function (boundingBox) {
			$scope.OSMSearchResults = [];
			var bbox = boundingBox;
			$rootScope.$broadcast('mapZoomToBBox', bbox);
		};

}]);

//Map controller for displaying stuff
app.controller('LeafLetMap', ['$rootScope', '$scope',
function($rootScope, $scope, currentMarkers, orderedMaps) {
	//initialize map
	$scope.LeafLetMapX = 51.505;
	$scope.LeafLetMapY = -0.09;
	$scope.LeafLetMapZ = 13;
	$scope.markers = [];

	$scope.map = L.map('mapid', {zoomControl:true}).setView([$scope.LeafLetMapX, $scope.LeafLetMapY], $scope.LeafLetMapZ);
	$scope.map.doubleClickZoom.disable();
	$scope.map.zoomControl.setPosition('topright');
	L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwczRwcmludCIsImEiOiJjaXducWZ3eXAwMDFiMnlueWZqMmFxNmlxIn0.tmenyXW08CjqjupZ_vNOpQ', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo($scope.map);

	//Add marker
	$scope.$on('addMarkerAtCenter', function (event) {
		var center = $scope.map.getCenter();
		$scope.markers.push(center);
		currentMarkers.addMarker(center);
		L.marker(center).addTo($scope.map);
	});

	$scope.$on('revomeMarker', function (event, $id) {

	});

	$scope.$on('mapZoomToBBox', function(event, bboxArray) {
		var northEast = L.latLng(bboxArray[0], bboxArray[2]);
		var southWest = L.latLng(bboxArray[1], bboxArray[3]);
		var bbox = L.latLngBounds(southWest, northEast);
		$scope.map.fitBounds(bbox);
	});

	//RemoveMap
	$scope.$on('addMap', function(event, bboxArray) {
		//make a default map
		var center = $scope.map.getCenter();

		$scope.map.fitBounds(bbox);
	});

	//Remove a map
	$scope.$on('removeMap', function(event, bboxArray) {
		var northEast = L.latLng(bboxArray[0], bboxArray[2]);
		var southWest = L.latLng(bboxArray[1], bboxArray[3]);
		var bbox = L.latLngBounds(southWest, northEast);
		$scope.map.fitBounds(bbox);
	});
}]);

//ViewOptions
app.controller('mapCtrl', ['$rootScope', '$scope',
function ($rootScope, $scope) {

	$scope.focusOnMap = function($id){
		var bounds = [];
		//only one map visible at a time
		L.rectangle(bounds, {color: "#ff7800", weight: 1}).addTo($scope.map);
		// zoom the map to the rectangle bounds
		$scope.map.fitBounds(bounds);
	}

	$scope.sendHeight = function() {
		$rootScope.$broadcast('heightChanged', $scope.Height);
	};

	$scope.sendWidth = function() {
		$rootScope.$broadcast('widthChanged', $scope.Width);
	};

	$scope.sendScale = function() {
		$rootScope.$broadcast('scaleChanged', $scope.Scale, $scope.Width, $scope.Height);
	};

}]);

//Tools
app.controller('Tools', ['$rootScope', '$scope',
function ($rootScope, $scope, orderedMaps) {
	$scope.addMarkerAtCenter = function() {
		$rootScope.$broadcast('addMarkerAtCenter');
	};
}]);

//Service for monitoring maps
app.service('orderedMaps', function(){
	var currentMaps = [[54.559322, -5.767822], [56.1210604, -3.021240]];

	return {
		getMaps: function(){
			return currentMaps;
		},

		setMaps: function(value){
			currentMaps = value;
		},

		addMap: function(map){
			currentMaps.push(map);
		},

		removeMap: function($id){
			currentMaps.splice($id, 1);
		}
	};
});

//Service for monitoring maps
app.service('currentMarkers', function(){
	var markers = [[54.559322, -5.767822],
				   [56.1210604, -3.021240]];

	return {
		getMarkers: function(){
			return markers;
		},

		getMarker: function($id){
			return markers[id];
		},

		setMarkers: function(value){
			markers = value;
		},

		addMarker: function(map){
			markers.push(map);
		},

		removeMarker: function($id){
			markers.splice($id, 1);
		}
	};
});