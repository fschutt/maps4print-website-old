<!DOCTYPE html>
<html>
  <!--head section to include on all sites-->
  <head>
    <title>
      404 Website not found | Maps4Print
    </title>
		<?php require_once 'php/templates/meta.php'; ?>
  </head>

  <body>
    <header class="header header-colored">
		<?php require_once 'php/templates/header.php'; ?>
      <div class="hero container-lrg flex center">
        <div class="col-6 centervertical text-center">
          <h1 class="heading">
            404 - Website nicht gefunden
          </h1>
        </div>
      </div>

      <div class="container-sml flex text-center" style="flex-direction: column;">
          <div class="col-12">
            <div class="offset-top ctas center">
              <a href="./index.php" class="logo">
              <div class="ctas-button lrg">
                      Zurück&nbsp;zur&nbsp;Startseite
              </div>
              </a>
            </div>
          </div>
        </div>
      <div id="spacer" style="height: 200px;"></div>

      <footer class="footer">

        <?php require_once 'php/templates/footer.php'; ?>
      </footer>

      <script src="./js/jquery.js"></script>
      <script src="./js/slider.js" async defer></script>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-60768709-4', 'auto');
        ga('send', 'pageview');

      </script>
    </header>
    <!--End header-->
  </body>
</html>
