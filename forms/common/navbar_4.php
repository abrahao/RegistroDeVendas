<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex align-items-center">
    <a class="navbar-brand brand-logo" href="/index.php">
      <img src="../../images/logo" alt="logo" class="logo-dark" />
    </a>
    <a class="navbar-brand brand-logo-mini" href="/index.php"><img src="/images/favicon.png" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
    <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Visualização das Respostas do Questionário por Cliente</h5>
    <ul class="navbar-nav navbar-nav-right ">
      <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
        <a class="nav-link dropdown-toggle"><br>
          <img class="img-xs rounded-circle ml-2" src="/images/faces/face8.png"> <span class="font-weight-normal"><?= $_SESSION['user'] ?></span></a>
        <div>
          <a><i class="dropdown-item-icon icon-power text-primary"></i><a href="/login.php">Sair</a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>