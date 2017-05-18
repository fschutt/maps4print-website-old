<?
require_once 'php/crm/core/init.php';
Authorization::checkAndRedirect();
?>

<!DOCTYPE html>
<html>
  <!--head section to include on all sites-->
  <head>
    <title>
      Administration | Maps4Print
    </title>
    <?php require_once 'php/templates/meta.php'; ?>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
  </head>

  <body>
    <header class="header header-colored">
    <?php require_once 'php/templates/header.php'; ?>
    </header>
    <!--end header-->

    <div class="container-lrg flex">
      <div class="col-12">
        <h1 class="heading ">
          Administration
        </h1>
          <input id="todo-search" type="search" name="" placeholder="Suche..." />
          <table id="table-todo">
            <thead>
              <th id="id">ID</th>
              <th id="status">Status</th>
              <th id="date">Datum</th>
              <th id="description">Beschreibung</th>
              <th id="details"></th>
            </thead>
            <tr>
              <td>655</td>
              <td>Erledigt</td>
              <td>01.12.2017 12:14</td>
              <td>Berichtigung Schriften</td>
              <td><a href="#">Details</a></td>
            </tr>
          </table>
      </div>
    </div>

    <div class="spacer3em"></div>
    <footer class="footer footer-colored">
      <?php require_once 'php/templates/footer.php'; ?>
    </footer>
  </body>
</html>
