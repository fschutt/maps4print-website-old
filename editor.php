<!DOCTYPE html>
<html>
  <!--head section to include on all sites-->
  <head>
    <?php require_once 'php/templates/meta.php'; ?>
    
    <script src="js/leaflet.js"></script>
    <link rel="stylesheet" href="css/leaflet.css">
    <link rel="stylesheet" href="css/editor.css">
    <link rel="stylesheet" href="css/select-style.css">

    <script src="js/angular.min.js"></script>
    <script src="js/select-map.js"></script>
    <script src="js/select-style.js"></script>
  </head>

  <body ng-app="M4POrderProcess">
    <header class="header header-colored">
    <?php require_once 'php/templates/header.php'; ?>
    </header>
    <!--end header-->
    <div class="m4p-order-process shadow" >
        <div class="container-lrg">
            <div class="m4p-order-process-font horizontal">
                <h2 class="subheading" ng-class="(orderProcessSlideNum==1) ? 'active' : ''">
                    1.&nbsp;Kartenausschnitt wählen
                </h2>
                <h2 class="subheading" ng-class="(orderProcessSlideNum==2) ? 'active' : ''">2.&nbsp;Stil wählen</h2>
                <h2 class="subheading" ng-class="(orderProcessSlideNum==3) ? 'active' : ''">3.&nbsp;Bestellen</h2>
            </div>
        </div>
    </div>

    <div id="order-switch" ng-switch on="orderProcessSlideNum" ng-controller="OrderProgress">
        <div class="order-switch-page" ng-switch-when="1" >
            <ng-include class="page-content-wrapper" src="'php/editor/select-map.php'"></ng-include>
        </div>
        <div class="order-switch-page" ng-switch-when="2">
            <ng-include class="page-content-wrapper" src="'php/editor/select-style.php'"></ng-include>
        </div>
        <div class="order-switch-page" ng-switch-when="3">
            <ng-include class="page-content-wrapper" src="'php/editor/order-map.php'"></ng-include>
        </div>
        <div class="order-switch-page" ng-switch-default>
            <ng-include class="page-content-wrapper" src="'php/editor/select-map.php'"></ng-include>
        </div>
    </div>
  </body>
</html>
