    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"><img src="../../assets/images/logo.svg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../assets/images/logo-mini.svg" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-flex  mr-2">
              <a class="nav-link" href="#">
                Help
              </a>
            </li>
            <li class="nav-item dropdown d-flex">
              <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                <i class="typcn typcn-message-typing"></i>
                <span class="count bg-success">2</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                    </h6>
                    <p class="font-weight-light small-text mb-0">
                      The meeting is cancelled
                    </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown  d-flex">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="typcn typcn-bell mr-0"></i>
                <span class="count bg-danger">2</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="typcn typcn-info-large mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                    <p class="font-weight-light small-text mb-0">
                      Just now
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="typcn typcn-cog mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                    <p class="font-weight-light small-text mb-0">
                      Private message
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="typcn typcn-user-outline mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                    <p class="font-weight-light small-text mb-0">
                      2 days ago
                    </p>
                  </div>
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu">
              ::before
            </span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close typcn typcn-delete-outline"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options" id="sidebar-light-theme">
              <div class="img-ss rounded-circle bg-light border mr-3"></div>
              Light
            </div>
            <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
              <div class="img-ss rounded-circle bg-dark border mr-3"></div>
              Dark
            </div>
          </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-image">
                  <img src="../../assets/images/faces/face29.png" alt="image">
                  <span class="sidebar-status-indicator"></span>
                </div>
                <div class="sidebar-profile-name">
                  <p class="sidebar-name">
                    <?php $_SESSION['username'] ?>
                  </p>
                  <p class="sidebar-designation">
                    Welcome
                  </p>
                </div>
              </div>
              <div class="nav-search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
                  <div class="input-group-append">
                    <span class="input-group-text" id="search">
                      <i class="typcn typcn-zoom"></i>
                    </span>
                  </div>
                </div>
              </div>
              <p class="sidebar-menu-title">Dash menu</p>
            </li>
            <?php if ($_SESSION['level'] == 'masyarakat') { ?>
            <li class="nav-item">
              <a class="nav-link" href="http://<?= $_SERVER['SERVER_NAME'] ?>/pengaduan-masyarakat/modul/modul-profile/index.php">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Profile</span>
              </a>
            </li>
            <?php }?>
            <?php if ($_SESSION['level'] == 'admin') { ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="http://<?= $_SERVER['SERVER_NAME'] ?>/pengaduan-masyarakat/modul/modul-masyarakat/index.php">
                <i class="typcn typcn-briefcase menu-icon"></i>
                <span class="menu-title">Masyarakat</span>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="http://<?= $_SERVER['SERVER_NAME'] ?>/pengaduan-masyarakat/modul/modul-pengaduan/index.php">
                <i class="typcn typcn-film menu-icon"></i>
                <span class="menu-title">Pengaduan</span>
              </a>
            </li>
            <?php if ($_SESSION['level'] == 'admin') { ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="http://<?= $_SERVER['SERVER_NAME'] ?>/pengaduan-masyarakat/modul/modul-petugas/index.php">
                <i class="typcn typcn-chart-pie-outline menu-icon"></i>
                <span class="menu-title">Petugas</span>
              </a>
            </li>
            <?php }?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="http://<?= $_SERVER['SERVER_NAME'] ?>/pengaduan-masyarakat/modul/modul-tanggapan/index.php">
                <i class="typcn typcn-th-small-outline menu-icon"></i>
                <span class="menu-title">Tanggapan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="http://<?= $_SERVER['SERVER_NAME'] ?>/pengaduan-masyarakat/modul/modul-auth/login.php">
                <i class="typcn typcn-delete-outline menu-icon"></i>
                <span class="menu-title">Logout</span>
              </a>
            </li>
          </ul>
         </nav>