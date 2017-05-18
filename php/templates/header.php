<? require_once 'php/crm/core/init.php'; ?>

<div class="container-lrg">
  <div class="col-12 spread">
    <div>
	    <a class="logo" href="./index.php">
      		<img src="./img/logo.svg">
    	</a>
    </div>
    <nav class="center">
    <a class="nav-link" href="./index.php">
      <? echo $lang->get("GLOBAL_HOMEPAGE"); ?>
    </a>
    <a class="nav-link" href="./editor.php">
      <? echo $lang->get("GLOBAL_MAP_EDITOR"); ?>
    </a>
    <a class="nav-link" href="./services.php">
      <? echo $lang->get("GLOBAL_SERVICES"); ?>
    </a>

    <? if($user->isLoggedIn(Cookie::get(Config::get('cookie/cookie_name')))){ ?>

      <nav class="nav-link-dropdown">
        <ul>
          <li class="active">
            <a href="./account.php">
              <? echo $lang->get("GLOBAL_MY_ACCOUNT"); ?>
            </a>
          </li>
          <li>
            <a href="./account_settings.php">
            <? echo $lang->get("GLOBAL_SETTINGS"); ?>
            </a>
          </li>
          <li>
            <a href="./account_logout.php">
            <? echo $lang->get("GLOBAL_LOGOUT"); ?>
            </a>
          </li>
        </ul>
      </nav>


    <? }else{ ?>

      <a class="nav-link" href="./login.php">
        <? echo $lang->get("GLOBAL_LOGIN"); ?>
      </a>
      <a class="nav-link" href="./register.php">
        <? echo $lang->get("GLOBAL_REGISTER"); ?>
      </a>

    <? } ?>

    </nav>
  </div>
</div>

<?
  //TODO: this is hacky. header.php HAS to come after meta.php on every page
  //but I don't see another way right now of restructuring this 
  if($user->isLoggedIn(Cookie::get(Config::get('cookie/cookie_name')))){
    $user->getAllData(Cookie::get(Config::get('cookie/cookie_name')));
  }
?>