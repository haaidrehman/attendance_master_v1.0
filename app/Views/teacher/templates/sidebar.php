<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-title">Menu</li>
                <li class="menu-item-has-children dropdown">
                    <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        View Atttendance
                    </a>
                    <div class="c_dm dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        //     $url = base_url().'teacher/d/attendance_detail/';
                        // for($i = 1; $i <= 12; $i++){
                        //     $url = $url.$i.'/y'.'/'.$date;
                        //     // echo "<a class='dropdown-item' href='$url'>Class $i</a>";
                        //     // if($i != 12){
                        //     //     echo "<div class='dropdown-divider'></div>";
                        //     // }
                        // }
                        
                        // $url = base_url().'teacher/d/attendance_detail/';
                        // foreach($records as $k => $v){
                        //     $url = base_url().'teacher/d/attendance_detail/'.$v['id'].'/'.$v['class'];
                        //     echo "<a class='dropdown-item' href='$url'>Class {$v['class']}</a>";
                        //     // if($i != 12){
                        //     //     echo "<div class='dropdown-divider'></div>";
                        //     // }
                        // }
                        echo view_cell('App\Controllers\Teacher::class_specific_attendance_cat');
                        ?>
                    </div>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        View Students
                    </a>
                    <div class="c_dm dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                       echo view_cell('App\Controllers\Teacher::class_specific_students');
                        ?>
                    </div>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        View Statistics
                    </a>
                    <div class="c_dm dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                       echo view_cell('App\Controllers\Teacher::class_specific_attendance_statistics');
                        ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</aside>
<div id="right-panel" class="right-panel">
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url().'/teacher/dashboard'; ?>">Dashboard</a>
                <a class="navbar-brand hidden" href="index.html"><img src="images/logo2.png" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><?php $this->renderSection('staff_greet'); ?></a>
                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?php echo base_url().'/teacher/logout'; ?>"><img
                            src="<?php echo base_url('public/assets/images/icons/logout.png'); ?>" alt="" width="17"
                        height="17">&nbsp;Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>