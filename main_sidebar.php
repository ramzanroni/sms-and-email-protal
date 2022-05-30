<?php  

$role=$_SESSION['role'];
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="home.php" class="brand-link">
    <img src="./dist/img/matlogo.png" alt="MatlifeLogo" class="brand-image">
    <span class="brand-text font-weight-light">SMS Portal</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- profile -->
        <!-- <li class="nav-item">
          <a href="#" class="nav-link" onclick="userProfile()">
            <i class="nav-icon fas fa-id-badge"></i>
            <p>
              Profile
            </p>
          </a>
        </li> -->
        <?php 
        if ($role=="superadmin") 
        {
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="department()">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Department
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="users()">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <?php
        }
        if (($role=="superadmin" || $role=="Admin") && $role !="User") {
          ?>
          <li class="nav-item">
<!--             <a href="#" class="nav-link" onclick="templete()">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Templete
              </p>
            </a> -->
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-envelope"></i>
              <p>
                Templete
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" onclick="templete('SMS')">
                  <i class="nav-icon fas fa-solid fa-envelope"></i>
                  <p>
                    SMS
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" onclick="templete('Email')">
                  <i class="nav-icon fas fa-sms"></i>
                  <p>
                    Email
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <?php
        }
        ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-solid fa-envelope"></i>
            <p>
              SMS
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="sms()">
                <i class="nav-icon fas fa-solid fa-envelope"></i>
                <p>
                  Send SMS
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="smsReport()">
                <i class="nav-icon fas fa-sms"></i>
                <p>
                  Send Report
                </p>
              </a>
            </li>
          </ul>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-at"></i>
              <p>
                Email
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" onclick="email()">
                  <i class="nav-icon fas fa-solid fa-at"></i>
                  <p>
                    Send Email
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" onclick="emailReport()">
                  <i class="nav-icon fas fa-mail-bulk"></i>
                  <p>
                    Email Report
                  </p>
                </a>
              </li>
            </ul>
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>