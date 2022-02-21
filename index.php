<?php
session_start();

if ($_COOKIE['user']) {
  $_SESSION['user'] = $_COOKIE['user'];
}

if (!$_SESSION['user']) {
  header('Location: login.php');
}
?>
<?php
include_once "./forms/common/head.php";
?>
<div class="container-scroller">
  <?php
  include_once "./forms/common/navbar.php";
  ?>
  <div class="container-fluid page-body-wrapper">
    <?php
    include_once "./forms/common/sidebar.php";
    ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include_once "./common/scripts.php";
  ?>
</div>