<!DOCTYPE html>
<html>
  <!--head section to include on all sites-->
  <head>
    <?php require_once 'php/templates/meta.php'; ?>
  </head>

  <body>
    <header class="header header-colored">
    <?php require_once 'php/templates/header.php'; ?>
    </header>
    <!--end header-->
    <div class="container-lrg">
      <div class="col-12 spread vertical">
        <h1 class="heading ">
          Registrieren
        </h1>
        <div class="offset-top"></div>
        <!--Register form-->
        <form action="php/crm/register.php" method="post" class="ctas vertical">

          <select class="ctas-input2"  name="gender" required value="<? echo Input::get('gender'); ?>">
            <option value="company">Firma</option>
            <option value="male">Herr</option>
            <option value="female">Frau</option>
          </select>

          <legend for="surname">Vorname</legend>
          <input class="ctas-input2" type="text" name="surname" required value="<? echo Input::get('surname'); ?>"></input>

          <legend for="lastname">Nachname</legend>
          <input class="ctas-input2" type="text" name="lastname" required value="<? echo Input::get('lastname'); ?>"></input>

          <legend for="email">E-Mail</legend>
          <input class="ctas-input2" type="text" name="email" required value="<? echo Input::get('email'); ?>"></input>

          <legend for="email_again">E-Mail wiederholen</legend>
          <input class="ctas-input2" type="text" name="email_again" value="" autocomplete="off">

          <legend for="password">Passwort</legend>
          <input class="ctas-input2" type="password" name="password" value="" autocomplete="off">

          <input type="hidden" name="token" value="<? echo Token::generate(); ?>"/>
          <div class="spacer3em"></div>
          <button type="submit" class="ctas-button small">Registrieren</button>
        </form>

      </div>
    </div>

    <div class="spacer3em"></div>
    <footer class="footer footer-colored">
      <?php require_once 'php/templates/footer.php'; ?>
    </footer>
  </body>
</html>
