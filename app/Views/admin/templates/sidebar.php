<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-title">Menu</li>
                <li class="menu-item-has-children dropdown">
                    <a href="<?php echo base_url('student/class'); ?>">New Registrations</a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Students
                    </a>
                    <div class="c_dm dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $url = base_url().'/class/detail/';
                    for($i = 1; $i <= 12; $i++){
                        
                        echo "<a class='dropdown-item' href='$url$i'>Class $i</a>";
                        if($i != 12){
                            echo "<div class='dropdown-divider'></div>";
                        }
                    }
                    ?>


                        <a class="dropdown-item" href="typo.html">Typography</a>
                    </div>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="<?php echo base_url('class/detail'); ?>">Add Student</a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="<?php echo base_url('teachers'); ?>">Staffs</a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="<?php echo base_url('teacher/add'); ?>">Add Staff</a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
<div id="right-panel" class="right-panel">
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url('home'); ?>">Admin</a>
                <a class="navbar-brand hidden" href="index.html"><img src="images/logo2.png" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Welcome Admin</a>
                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?php echo base_url('admin/logout'); ?>"><img
                                src="<?php echo base_url('public/assets/images/icons/logout.png'); ?>" alt="" width="17"
                                height="17">&nbsp;Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>