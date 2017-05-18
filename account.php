<?
require_once 'php/crm/core/init.php';
Authorization::checkAndRedirect();
?>

<!DOCTYPE html>
<html>
  <!--head section to include on all sites-->
  <head>
    <?php require_once 'php/templates/meta.php'; ?>
    <link rel="stylesheet" type="text/css" href="css/account.css"></link>
  </head>

  <body ng-app="customerBackend">
    <header class="header header-colored">
    <?php require_once 'php/templates/header.php'; ?>
    </header>
    <!--end header-->

    <div class="container-lrg flex">
      <div class="col-12">
        <h1 class="heading ">Hallo <? echo utf8_decode($user->data[0]->surname); ?>!</h1>

        <!--Orders-->
        <div class="offset-top"></div>
        <div class="horizontal spread">
          <h2 class="subheading centervertical">Bestellte Karten</h2>
          <input id="order-search" type="search" name="" class="right centervertical" placeholder="Bestellungen / Services durchsuchen..." ></input>
        </div>
        <section class="orders" ng-controller="customerOrderTable">
          <div class="order" ng-repeat="shopping_cart in shopping_carts">
              <!--BEGIN SINGLE ORDER-->
              <div class="order-map" ng-repeat="map in shopping_cart">
                <div class="order-heading">
                  <h4 class="order-map-name" ng-bind="map.map_name" ></h4>
                  <span class="order-status" ng-switch="map.map_status">
                      <p ng-switch-when="ORDERED">Bestellt</p>
                      <p ng-switch-when="QUEUED">In Warteschleife</p>
                      <p ng-switch-when="PROCESSING">In Bearbeitung</p>
                      <p ng-switch-when="WAIT_PAYMENT">Warten auf Zahlung</p>
                      <p ng-switch-when="PAYED">Bezahlt</p>
                      <p ng-switch-when="CANCELED">Storniert</p>
                      <p ng-switch-when="ARCHIVED">Archiviert</p>
                      <p ng-switch-default>Bestellt</p>
                  </span>
                </div>
                <div class="content-left">
                  <!--MAP PREVIEW-->
                  <p ng-bind="map.map_north"></p>
                  <p ng-bind="map.map_east"></p>
                  <p ng-bind="map.map_west"></p>
                  <p ng-bind="map.map_south"></p>
                </div>
                <div class="content-right">
                  <div class="text-left">
                    <p>Kartenmaße: </p>
                    <p>Maßstab: </p>
                    <p>Vorraussichtl. Fertigstellung: </p>
                  </div>
                  <div class="text-right">
                    <p ng-bind="(map.map_width / 10) + ' cm x ' + (map.map_height / 10) + ' cm'"></p>
                    <p ng-bind="'1 : ' + map.map_scale"></p>
                    <p ng-if="map.map_finished == NULL">
                      -
                    </p>
                    <p ng-if="map.map_finished != NULL">
                      {{map.map_finished}}
                    </p>
                  </div>
                  <div class="services" ng-repeat="service in map.map_services">
                    <p ng-bind="service.srv_type"></p>
                  </div>
                </div>
                <div class="actions-bottom">
                  <a href="#">Datei herunterladen</a>
                  <a href="#">Rechnung</a>
                  <a href="#">Reklame</a>
                </div>
              </div>
              <!--END SINGLE ORDER-->
          </div>
        </section>
      </div>
    </div>

    <div class="spacer3em"></div>
    <footer class="footer footer-colored">
      <?php require_once 'php/templates/footer.php'; ?>
    </footer>
  </body>
  <script src="js/angular.min.js"></script>
  <script type="text/javascript" src="js/account.js"></script>
</html>