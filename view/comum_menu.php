<div class="container">
  <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="sr-only">Ecommerce</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Ecommerce</a>
  </div>
  <ul class="navbar-nav nav nav-pills">
      <li class="active"><a href="<?= BASE_URL ?>"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
      <li><a href="<?= BASE_URL ?>anuncio/home"><span class="glyphicon glyphicon-usd"></span> Anúncios</a></li>
      <li><a href="<?= BASE_URL ?>pessoa/home"><span class="glyphicon glyphicon-user"></span> Pessoas</a></li>
      <li><a href="<?= BASE_URL ?>usuario/home"><span class="glyphicon glyphicon-hand-up"></span> Usuários</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-wrench"></span>
          <?= $_SESSION["username"] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?= BASE_URL ?>comum/logout">Sair</a>
        </div>
      </li>      
  </ul>
</div>  