<!DOCTYPE html>
<html>
  <!--head section to include on all sites-->
  <head>
    <title>
      Anmelden | Maps4Print - Karten online bestellen
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
          Anmelden
        </h1>
        <form  action="" class="ctas vertical" method="post">
          <legend for="email">E-Mail</legend>
          <input class="ctas-input2" type="text" name="email" value="<? echo Input::get('email'); ?>"></input>
          <legend for="password">Passwort</legend>
          <input class="ctas-input2" type="password" name="password" value="" autocomplete="off">
          <a href="reset-pw.php" class="link small">Passwort vergessen?</a>
          <input type="hidden" name="token"/>
          <div class="spacer3em"></div>
          <button type="submit" class="ctas-button small">Anmelden</button>
        </form>
      </div>
    </div>

    <!--Footer-->
    <div class="spacer3em"></div>
    <div class="spacer3em"></div>
    <div class="spacer3em"></div>
    <div class="spacer3em"></div>
    <div class="spacer3em"></div>
    <div class="spacer3em"></div>
    <!--TODO: Not really a good solution-->

    <footer class="footer footer-colored">
      <?php require_once 'php/templates/footer.php'; ?>
    </footer>
  </body>
</html>
