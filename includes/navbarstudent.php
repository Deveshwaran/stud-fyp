<?php 
  //Include session in navbar so all pages has session included
  include('session.php');
?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="home.php" class="logo d-flex align-items-center">
      <img src="../assets/img/logo.png" alt="">
      <span class="d-none d-lg-block">StudFYP</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          
          <span class="d-none d-md-block"><?php echo $_SESSION['name'];?></span>
          <i class="bi bi-person-fill dropdown-toggle ps-2"></i>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $_SESSION['name'];?></h6>
            <span>Final Year Student</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logout">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="home.php" id="home">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="viewsupervisor.php" id="viewsupervisor">
        <i class="bi bi-person-square"></i>
        <span>Supervisor Info</span>
      </a>
    </li><!-- Supervisor Info Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="logbook.php" id="logbook">
        <i class="bi bi-journal-text"></i>
        <span>Logbook</span>
      </a>
    </li><!-- Logbook Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="rating.php" id="rating" target="_blank">
        <i class="bi bi-bar-chart-line"></i>
        <span>Rating</span>
      </a>
    </li><!-- Rating -->

  </ul>

</aside><!-- End Sidebar-->

<!-- Logout Modal -->
<div class="modal fade" id="logout" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to logout?
      </div>
      <div class="modal-footer">
        <a href="logout.php" class="btn btn-primary" name="logout">Yes</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div><!-- Logout Modal-->