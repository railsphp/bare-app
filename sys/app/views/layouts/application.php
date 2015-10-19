<!doctype html>
<html class="dhd">
<head>
  <title>Page title</title>
  
  <?= $this->javascriptIncludeTag('application') ?> 
  <?= $this->stylesheetLinkTag('application') ?> 
  
  <link rel="shotcut icon" type="image/png" href="<?= '/favicon.png' ?>" />
  
  <meta name="viewport" content="width=device-width" />
</head>
<body class="top-navbar">
  <div id="notice-container"></div>
  <div class="navbar navbar-inverse navbar-fixed-top navbar-main">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="#", class="navbar-brand">Images WebSite</a>
      </div>
      
      <div class="navbar-collapse collapse top-navbar">
        <ul class="nav navbar-nav">
          <li id="cookie-footer-notice">
            <div><small>Este sitio usa cookies. Clic <a href="#">aquí</a> para más información. <a href="#" title="Ocultar anuncio"><span class="glyphicon glyphicon-remove-circle cookie-hide"></span></a></small></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  
  <section class="container container-main">
  
    <div class="row row-main">
      <?= $this->contents() ?>
    </div>
  </section>

  <section class="footer-container">
    <footer class="container">
      <div>
        &copy; 2014 Foobar
      </div>
    </footer>
  </section>
</body>
</html>
