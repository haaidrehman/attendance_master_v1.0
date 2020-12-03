
<aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>
                  <li class="menu-item-has-children dropdown">
                     <a href="<?php echo base_url('student/profile'); ?>" >Profile</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="<?php echo base_url('student/notification'); ?>" >Notification</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="<?php echo base_url('student/attendance'); ?>" >Attendance</a>
                  </li>
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="<?php echo base_url('/student/account'); ?>">Student</a>
                  <a class="navbar-brand hidden" href="index.html"><img src="images/logo2.png" alt="Logo"></a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome Student</a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?php echo base_url('student/logout'); ?>"><img src="<?php echo base_url('public/assets/images/icons/logout.png'); ?>" alt="" width="17" height="17">&nbsp;Logout</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         