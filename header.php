<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="beranda.php" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">Sistem Pakar DBD</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="assets/img/profil.png" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">
          <?php echo ucwords($nama); ?>
        </span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>
            <?php echo ucwords($nama); ?>
          </h6>
          <span>
            <?php echo ucfirst($role); ?>
          </span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <form id="editProfileForm" action="editUserForm.php" method="post" class="d-none">
            <input type="hidden" name="edit">
            <input type="hidden" name="idUser" value="<?php echo $idUserAktif; ?>">
          </form>
          <a class="dropdown-item d-flex align-items-center" href="#" onclick="document.getElementById('editProfileForm').submit();">
            <i class="bi bi-person"></i>
            <span>Kelola Profil Saya</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="logout.php">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->