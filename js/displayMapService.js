var app = angular.module('M4POrderProcess', []);

//MUST BE AVAILABLE ON PAGE LOAD
/*LEAFLET DISPLAY SERVICE AND CONTROLLER*/
app.factory('leafletDisplayMapService', function () {
    var currentlyActiveMap = [];
	var map = L.map('mapid');

	//array of references to L.rectangle
	//for adding and removing rectangles
	var visibleRectangles = [];

	//INIT
	map.zoomControl.setPosition('topright');
	map.setView([51.505, -0.09], 13);
	L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwczRwcmludCIsImEiOiJjaXducWZ3eXAwMDFiMnlueWZqMmFxNmlxIn0.tmenyXW08CjqjupZ_vNOpQ', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	//TODO: Project markers and maps onto the map CRS
	//Make buttons for dragging and changing boundaries of the map
	//Draw the currently hovered map in blue, the other ones in darker grey

	//DEBUG: ADD MARKER
	var LeafIcon = L.Icon.extend({
	    options: {
	        shadowUrl: 'leaf-shadow.png',
	        iconSize:     [38, 95],
	        shadowSize:   [50, 64],
	        iconAnchor:   [22, 94],
	        shadowAnchor: [4, 62],
	        popupAnchor:  [-3, -76]
	    }
	});

	var greenIcon = new LeafIcon({iconUrl: 'leaf-green.png'}),
	    redIcon = new LeafIcon({iconUrl: 'leaf-red.png'}),
	    orangeIcon = new LeafIcon({iconUrl: 'leaf-orange.png'});

	L.marker([51.5, -0.09], {icon: greenIcon}).addTo(map);



	//-------
	var popupLocation1 = new L.LatLng(51.5, -0.09);
	var popupLocation2 = new L.LatLng(51.51, -0.08);

	var popupContent1 = '<b>Hello world!<br />This is a nice popup.</b>',
	popup1 = new L.Popup();

	popup1.setLatLng(popupLocation1);
	popup1.setContent(popupContent1);

	var popupContent2 = '<p>Hello world!<br />This is a nice popup.</p>',
	popup2 = new L.Popup();

	popup2.setLatLng(popupLocation2);
	popup2.setContent(popupContent2);

	map.addLayer(popup1).addLayer(popup2);
	//---------
	return {
		//Create the coordinates for a map (a rectangle)
		//in coordinates
		getNewMapCoordinates: function (width, height) {
			var bounds = map.getBounds();
			var north = bounds._northEast.lat;
			var south = bounds._southWest.lat;
			var east = bounds._northEast.lng;
			var west = bounds._southWest.lng;

			var center = map.getCenter();

			var northSouthDistance = north - south;
			var eastWestDistance = east - west;

			//since the map is in landscape mode, 20 % padding around the current map area
			var absNorth = south + (northSouthDistance / 100 * 90);
			var absSouth = south + (northSouthDistance / 100 * 10);

			//TODO: Landscape maps on init
			//The initial maps will all be A4 portrait for now, maybe this will change later
			var absNorthSouthDistance = absNorth - absSouth;
			var mapWidthDegrees = absNorthSouthDistance / height * width;

			var absEast = center.lng - mapWidthDegrees / 2;
			var absWest = center.lng + mapWidthDegrees / 2;

			return {north: absNorth, 
					south: absSouth, 
					east: absEast, 
					west: absWest};
		},
		changeBBox: function(newNorth, newEast, newSouth, newWest){
			var northEast = L.latLng(newNorth, newEast);
			var southWest = L.latLng(newSouth, newWest);
			var bbox = L.latLngBounds(southWest, northEast);
			map.fitBounds(bbox);
		},
		addRectangleMap: function (currentMap) {
			//TODO: How to update the map when this happens
			var bounds = [[currentMap.south, currentMap.west], [currentMap.north, currentMap.east]];
			var rect = L.rectangle(bounds, {color: "#111111", weight: 2});
			visibleRectangles[currentMap.id] = rect;
            map.addLayer(rect);
		},
		removeRectangleMap: function (id) {
			map.removeLayer(visibleRectangles[id]);
		},
		changeMap(currentMap){
			var bounds = [[currentMap.south, currentMap.west], [currentMap.north, currentMap.east]];
			visibleRectangles[currentMap.id].setBounds(bounds);
		}
   };
});

//Controller for displaying rendering the rectangles and the map
app.controller('leafletDisplayCtrl', ['$scope', 'leafletDisplayMapService', 'orderProcessService', 
function($scope, leafletDisplayMapService, orderProcessService) {
	


}]);
