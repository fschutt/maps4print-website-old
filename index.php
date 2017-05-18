<html>
  <!--head section to include on all sites-->
  <head>
		<?php require_once 'php/templates/meta.php'; ?>
  </head>

  <body>
    <header class="header header-colored">
		<?php require_once 'php/templates/header.php'; ?>

      <div class="hero container-lrg flex">
        <div class="col-6 centervertical">
          <h1 class="heading">
            <? echo $lang->get("SECTION_1_HEADER"); ?>
          </h1>
          <h2 class="paragraph ">
            <? echo $lang->get("SECTION_1_DESC"); ?>
          </h2>
          <div class="offset-top"></div>
					<form class="ctas">
	          <input class="ctas-input" type="text" placeholder= <? echo "'".$lang->get("SECTION_1_SEARCH_PLACEHOLDER")."'"; ?> />
	          <div class="ctas-button">
              <i class="material-icons">&#xE8B6;</i>
            </div>
					</form>
        </div>
        <div class="col-6 sidedevices">
          <div class="browserwrapper">
            <img class="mask-img hero-shadow" src="./img/browser-hero.svg" alt=<? echo "'".$lang->get("SECTION_1_IMAGE_ALT")."'"; ?>>
          </div>
        </div>
      </div>
    </header>
    <!--End header-->
    <div class="feature feature4">
      <div class="container-lrg flex">
        <div class="col-5">
          <h3 class="subheading">
            <? echo $lang->get("SECTION_2_HEADER"); ?>
          </h3>
          <p class="paragraph">
            <? echo $lang->get("SECTION_2_DESC"); ?>
          </p>
        </div>
        <div class="col-1">
        </div>
        <div class="col-6">
          <div class="sidedevices">
            <div class="browserwrapper">
                  <img class="mask-img" src="./img/browser-hero.svg" alt=<? echo "'".$lang->get("SECTION_2_IMAGE_ALT")."'"; ?> >
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--End 1st section-->
    <div class="feature feature6">
      <div class="container-lrg horizontal">
        <div class="col-5 verticalcenter">
            <h3 class="subheading">
              <? echo $lang->get("SECTION_3_HEADER_1"); ?>
            </h3>
            <p class="paragraph">
            <? echo $lang->get("SECTION_3_DESC_1"); ?>
            </p>

            <h3 class="subheading">
            <? echo $lang->get("SECTION_3_HEADER_2"); ?>
            </h3>
            <p class="paragraph">
            <? echo $lang->get("SECTION_3_DESC_2"); ?>
            </p>
        </div>
        <div class="col-1"></div>
        <div class="col-6">
          <div id="slider">
            <a class="control_next">&rarr;</a>
            <a class="control_prev">&larr;</a>
            <ul>
              <li style="background-image: url('./img/webapp.svg');">SLIDE 1</li>
              <li style="background-image: url('./img/webapp.svg');">SLIDE 2</li>
              <li style="background-image: url('./img/webapp.svg');">SLIDE 3</li>
              <li style="background-image: url('./img/webapp.svg');">SLIDE 4</li>
            </ul>  
          </div>
        </div>
      </div>
    </div>

    <div class="feature feature5">
      <div class="container-lrg flex text-center">
        <div class="col-12">
          <h3 class="heading">
            <? echo $lang->get("SECTION_4_HEADER_0"); ?>
          </h3>
        </div>
      </div>
      <div class="container-lrg flex">
        <div class="col-5">

            <h3 class="subheading">
            <? echo $lang->get("SECTION_4_HEADER_1"); ?>
            </h3>
            <p class="paragraph">
              <? echo $lang->get("SECTION_4_DESC_1"); ?>
            </p>


            <h3 class="subheading">
              <? echo $lang->get("SECTION_4_HEADER_2"); ?>
            </h3>
            <p class="paragraph">
              <? echo $lang->get("SECTION_4_DESC_2"); ?>
            </p>

        </div>
        <div class="col-1">
        </div>
        <div class="col-6">
          <div class="browserwrapper">
            <div class="mask">
              <img class="mask-img" style="width:100%;" src="./img/map-hovering-hero.svg" alt=<? echo "'".$lang->get("SECTION_4_IMAGE_ALT")."'"; ?>>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--FEATURE-->
    <div class="feature feature6">
      <div class="container-lrg horizontal">
        <div class="col-5 verticalcenter">
            <h3 class="subheading">
              <? echo $lang->get("SECTION_5_HEADER_1"); ?>
            </h3>
            <p class="paragraph">
              <? echo $lang->get("SECTION_5_DESC_1"); ?>
            </p>

            <h3 class="subheading">
              <? echo $lang->get("SECTION_5_HEADER_2"); ?>
            </h3>
            <p class="paragraph">
              <? echo $lang->get("SECTION_5_DESC_2"); ?>
            </p>
        </div>
        <div class="col-1"></div>
        <div class="col-6">

        </div>
      </div>
    </div>

    <!--FEATURE-->
    <div class="feature feature5">
      <div class="container-lrg horizontal">
        <div class="col-5 verticalcenter">
            <h3 class="subheading">
              <? echo $lang->get("SECTION_6_HEADER_1"); ?>
            </h3>
            <p class="paragraph">
              <? echo $lang->get("SECTION_6_DESC_1"); ?>
            </p>
        </div>
        <div class="col-1"></div>
        <div class="col-6">

        </div>
      </div>
    </div>

    <!--Footer-->
    <footer class="footer footer-colored">
        <div class="container-lrg flex text-center offset-top">
          <div class="col-12">
            <h3 class="heading">
              <? echo $lang->get("SECTION_7_HEADER_1"); ?>
            </h3>
            <div class="offset-top"></div>
            <div class="ctas center">
              <a href="./editor.php" class="logo" style="text-decoration: none;">
              <div class="ctas-button lrg">
                <? echo $lang->get("SECTION_7_BUTTON_1"); ?>
              </div>
              </a>
            </div>
            <div class="spacer3em"></div>
          </div>
        </div>
        <div class="spacer3em"></div>
    		<?php require_once 'php/templates/footer.php'; ?>
    </footer>

  <script src="./js/slider.js" async defer></script>
  </body>
</html>
