<header class="main-header ">

        <!-- Logo -->
        <a href="../dashboard" class="logo bg-primary">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src='../dist/img/ffc.png' /></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>FFCL</b> System</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top bg-primary" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
           
             <li><a href='#' id='date_time'><?php echo date('F d, Y l h:i A');?></a></li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu      ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- <?php
                      $image="../administrator/user_image/{$_SESSION[WEBAPP]['user']['image']}";
                  ?> -->
                  <img src="<?php echo $image;?>" class="user-image" alt="User Image">
                  <span class="hidden-xs">
                  
                    <?php
                        echo htmlspecialchars("{$_SESSION[WEBAPP]['user']['last_name']}, {$_SESSION[WEBAPP]['user']['first_name']} {$_SESSION[WEBAPP]['user']['middle_initial']}")
                      ?> 
                  </span>
                </a>


                <ul class="dropdown-menu ">
                  <!-- User image -->
                  <li class="user-header bg-primary">
                    <img src="<?php echo $image;?>" class="img-circle" alt="User Image">
                    <p> 
                     <?php
                        echo htmlspecialchars("{$_SESSION[WEBAPP]['user']['last_name']}, {$_SESSION[WEBAPP]['user']['first_name']} {$_SESSION[WEBAPP]['user']['middle_initial']}")
                      ?> 
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left bg-primary">
                      <a href="../administrator/user_profile.php" class="btn bg-primary btn-flat">Profile</a>
                    </div>
                    <div class="pull-right bg-primary">
                      <a href="../logout.php" class="btn bg-primary btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

        </nav>
      </header>
