<!DOCTYPE html>
<html>
  <!--head section to include on all sites-->
  <head>
    <title>
      Passwort zurücksetzen | Maps4Print - Karten online bestellen
    </title>
    <?php require_once 'php/templates/meta.php'; ?>
  </head>

  <body>
    <header class="header header-colored">
    <?php require_once 'php/templates/header.php'; ?>
    </header>
    <!--end header-->

    <div class="container-lrg">
      <div class="col-12 spread vertical">
        <h1 class="heading">
          Passwort zurücksetzen
        </h1>
        <div class="offset-top"></div>
        <h2 class="subheading">Bitte geben Sie die E-Mail ein, für dessen Account Sie das Passwort zurücksetzen möchten.</h2>
        <form  action="" class="ctas vertical" method="post">
          <legend for="email">E-Mail</legend>
          <input class="ctas-input2" type="email" name="email"></input>
          <input type="hidden" name="token"/>
          <div class="offset-top"></div>

          <button type="submit" class="ctas-button small">Passwort&nbsp;zurücksetzen</button>
        </form>
      </div>
    </div>

    <!--TODO: Register form-->

    <!--Footer-->
    <div class="spacer3em"></div>
    <div class="spacer3em"></div>
    <div class="spacer3em"></div>

    <footer class="footer footer-colored">
      <?php require_once 'php/templates/footer.php'; ?>
    </footer>
  </body>
</html>
