<div class="footer-wrapper">
  <div class="container-lrg footer-nav center">
    <nav class="col-3 vertical">
      <a class="logo" href="./index.php">
          <img src="./img/logo.svg"></img>
      </a>
      <a class="nav-link2" href="./contact.php">
        <? echo $lang->get("GLOBAL_CONTACT"); ?>
      </a>
      <a class="nav-link2" href="./tos.php">
        <? echo $lang->get("GLOBAL_TERMS_OF_SERVICE"); ?>
      </a>
      <a class="nav-link2" href="./privacy.php">
        <? echo $lang->get("GLOBAL_PRIVACY"); ?>
      </a>
    </nav>
    <nav class="col-3 vertical">
      <a class="nav-link2" href="./editor.php">
        <? echo $lang->get("GLOBAL_MAP_EDITOR"); ?>
      </a>
      <a class="nav-link2" href="./services.php">
        <? echo $lang->get("GLOBAL_SERVICES"); ?>
      </a>

    <?
      require_once 'php/crm/core/init.php';
      if($user->isLoggedIn(Cookie::get(Config::get('cookie/cookie_name')))){
    ?>

      <a class="nav-link2" href="./account.php">
        <? echo $lang->get("GLOBAL_MY_ACCOUNT"); ?>
      </a>

    <? }else{ ?>

      <a class="nav-link2" href="./login.php">
        <? echo $lang->get("GLOBAL_LOGIN"); ?>
      </a>
      <a class="nav-link2" href="./register.php">
        <? echo $lang->get("GLOBAL_REGISTER"); ?>
      </a>

    <? }?>

    </nav>
  </div>
  <div class="container-lrg footer-nav center">
    <small class="copyright center">
    &copy;2016&nbsp;Maps4Print&nbsp;UG (haftungsbeschänkt)
    </small>
  </div>
</div>