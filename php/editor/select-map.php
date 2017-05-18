<!--Background map-->
<div class="m4p-editor-map shadow noselect" id="mapid" ng-controller="LeafLetMap" ng-init="updateZoom()" ng-scroll="updateZoom()">

    <!--Search box-->
    <div id="m4p-search" class="shadow" ng-controller="Search" >
        <form ng-submit="OSMSearchFun()" id="m4p-search-box-form">
            <input type="text" placeholder="Stadt suchen" id="m4p-search-text" ng-model="OSMSearch" autofocus="autofocus" value="" aria-label="Stadt suchen" autocomplete="off"/>
            <div id="m4p-search-button" ng-click="OSMSearchFun()" value="" class="noselect">
                <i class="material-icons">&#xE8B6;</i>
            </div>
        </form>

        <div id="m4p-editor-search-results" ng-if="OSMSearchResults">
            <ul>
                <li ng-repeat="searchResult in OSMSearchResults" ng-bind="searchResult.display_name" ng-click="zoomToBBox(searchResult.boundingbox)">
                </li>
            </ul>
        </div>
    </div>

    <!--Set Marker-->
    <div id="m4p-set-marker" ng-click="addMarkerAtCenter()" class="shadow">
        <i class="large material-icons">&#xE567;</i>
        <strong>&nbsp;Marker&nbsp;setzen</strong>
    </div>
</div> 

<!--Order process sidebar-->
<div class="m4p-sidebar shadow">

    <h2 class="subheading">Karten</h2>
    <div id="m4p-sidebar-map-list">
        <ul>
            <li>
                <div class="m4p-map">
                    <div class="m4p-map-name">
                        <input type="text" placeholder="Kartenname  eingeben" maxlength="50"></input>
                        <i class="clickable" ng-click="zoomToMap()">&#xE3B4;</i>
                        <i class="m4p-map-remove-map noselect clickable" ng-click="removeMapFromList()">&#xE5CD;</i>
                    </div>
                    <div class="m4p-map-dimension">
                        <input type="number" placeholder="Breite"></input>
                        <p>mm&nbsp;x&nbsp;</p>
                        <input type="number" placeholder="Höhe"></input>
                        <p>mm</p>
                    </div>
                    <div class="m4p-map-scale">
                    <p>Masstab: 1 : </p>
                    <input type="number" placeholder="Masstab eingeben"></input>
                    <i class="clickable" class="noselect" ng-click="closeLockScale()">&#xE898;</i>
                    <i class="m4p-locked noselect clickable" ng-click="openLockScale()">&#xE897;</i>
                </div>
            </li>
        </ul>
        <a href="#" id="m4p-order-add-map" ng-click="addMapToMapList()">
            Karte&nbsp;hinzufügen
        </a>
    </div>
</div>