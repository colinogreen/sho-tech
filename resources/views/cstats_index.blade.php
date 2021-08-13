<?php

$bodyid = "page-top";
?>
@extends ("template.sbadmin_template")

@section("sbadmin2_content")

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route("cstats_index") }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">UK Covid Stats</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route("showcaseindex") }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route("cstats_index") }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php /*
            <!-- Divider -->
            <hr class="sidebar-divider">
            
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>
            */ ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            
            <?php /*
             * <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> */
            ?>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php /*
                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> */ ?>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <?php // <span class="badge badge-danger badge-counter">3+</span> ?>
                                <span id="alerts-center-count" class="badge badge-danger badge-counter"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div id="alerts-center-items" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <?php
                                /*
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                 * 
                                 */ ?>
                            </div>
                        </li>
                        <?php /*
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>
                        */ ?>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Alan Turing</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Covid Statistics for the UK</h1>
                       <?php /* <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> */ ?>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total cases to date<span id="total_cases_to_date_date"></span></div>
                                            <div id="total_cases_to_date" class="h5 mb-0 font-weight-bold text-gray-800">Please wait ...</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-briefcase-medical fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Deaths to date<span id="total_deaths_to_date_date"></span></div>
                                            <div id="total_deaths_to_date" class="h5 mb-0 font-weight-bold text-gray-800">Calculating ... </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-ambulance fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Cases for <span id="total_cases_for_date_date"></span>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div id="total_cases_for_date" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Calculating... </div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-briefcase-medical fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Deaths for  <span id="total_deaths_for_date_date"></span></div>
                                            <div id="total_deaths_for_date" class="h5 mb-0 font-weight-bold text-gray-800">Updating ...</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-ambulance fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Seven day average cases to <span id="average_weekly_cases_date_date"></span></div>
                                            <div id="average_weekly_cases_date" class="h5 mb-0 font-weight-bold text-gray-800">Please wait ...</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-notes-medical fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                      
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div id="cases-in-uk" class="in_page_link col-xl-6 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Covid Cases in the UK</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="stats-dropdown-menu dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Other Charts:</div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                       <?php // <canvas id="myAreaChart"></canvas> ?>
                                       <canvas id="covidCasesChart"></canvas>
                                    </div>
                                </div>
                             
                            </div>
                        </div>
                    <!-- Graph Cases per day Chart -->
                        <div id="cases--last-7-days" class="in_page_link col-xl-3 col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Cases - Last 7 days</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="stats-dropdown-menu dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Other Charts:</div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                    <?php //    <canvas id="myPieChart"></canvas> ?>
                                        <canvas id="casesSevenDays"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">

                                    </div>
                                </div>
                            </div>
                        </div>
  
						<!-- Graph Cases Average trend -->
                        <div id="average-cases-weekly" class="in_page_link col-xl-3 col-lg-3">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Average Weekly Cases trend</h6>
                                    
                                   
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="stats-dropdown-menu  dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Other Charts:</div>

                                        </div>
                                    </div> 
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                    <?php //    <canvas id="myPieChart"></canvas> ?>
                                        <canvas id="weeklyAverageCasesTrendChart"></canvas>
                                    </div>
                                 <div class="mt-4 text-center small">
                                   <?php /*       <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span> */ ?>
                                    </div>
                                </div>
                            </div>
                        </div>                  
                    
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        
                       <div id="covid-deaths-in-the-uk" class="in_page_link col-xl-6 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div id="" class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Covid Deaths in the UK</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="stats-dropdown-menu dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Other Charts:</div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                       <canvas id="covidDeathsChart"></canvas>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <!-- Bar Chart -->
                        <div id="expired-seven-days" class="in_page_link col-xl-3 col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Covid Deaths - Last seven days</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="stats-dropdown-menu dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Other Charts:</div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="deathsSevenDays"></canvas>
                                    </div>
                                   </div>
                            </div>
                        </div>
                     <div id="average-weekly-deaths-trend" class="in_page_link col-xl-3 col-lg-3">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Average Weekly Deaths trend</h6>

                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="stats-dropdown-menu dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Other Charts:</div>

                                        </div>
                                    </div> 
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="weeklyAverageExpiredTrendChart"></canvas>
                                    </div>
                                 <div class="mt-4 text-center small">
                                   <?php /*       <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span> */ ?>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                         <!-- Bar Chart -->
                        <div id="cases-per-month" class="in_page_link col-xl-3 col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Total cases per month (previous six months)</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="stats-dropdown-menu dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Other Charts:</div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="monthlyCasesTotalsSixMonth"></canvas>
                                    </div>
                                   </div>
                            </div>
                        </div>                       
                     <?php /*       
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div>

                        </div>  */ ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; sho.technohelp.uk <?= date("Y") ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script>
//** Move to resources/js script file when completed for npm compilation.

//* Debugging class. REMOVE | START

//class Greeting{
//    
//    constructor()
//    {
//        console.log("Greeting class: Hello world!");
//    }
//    
//    sayGoodbye()
//    {
//        console.log("Greeting.sayGoodbye() class: Goodbye world!");
//    }
//}


//* Debugging class. REMOVE | END

var global_result; //* Debugging in console. REMOVE
var post_data; //* Debugging in console. REMOVE
document.addEventListener('DOMContentLoaded', function () {
//new Greeting().sayGoodbye();

    function formatTodaysDate() {
        var d = new Date(),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    }

    post_data = $.post("/cvstats", {"date_from":"2020-02-01", "date_to":formatTodaysDate() , "_token": '{{csrf_token()}}'}, function(result){
        
       global_result = result; //* Debugging in console. REMOVE
       
       if(document.getElementById("total_cases_to_date")!== null)
       {         
            const cases_to_date = result.data[result.data.length -1].cases;
            const cases_today = result.data[result.data.length -1].cases_today;
            const deaths_to_date = result.data[result.data.length -1].expired;
            const deaths_today = result.data[result.data.length -1].expired_today;
            const to_date_date = " (" + result.data[result.data.length -1].date + ")";
            const weekly_average_cases = result.data[result.data.length -1].cases_average;
            //console.log(cases_to_date);

            $("#total_cases_to_date").html(number_format(cases_to_date));
            $("#total_cases_to_date_date").html(to_date_date);
            $("#total_deaths_to_date").html(number_format(deaths_to_date));
            $("#total_deaths_to_date_date").html(to_date_date);
            $("#total_cases_for_date_date").html(to_date_date);
            $("#total_cases_for_date").html(number_format(cases_today));
            $("#total_deaths_for_date_date").html(to_date_date);
            $("#total_deaths_for_date").html(number_format(deaths_today));
            $("#average_weekly_cases_date").html(number_format(weekly_average_cases));
            $("#average_weekly_cases_date_date").html(to_date_date);
       }
        const cColor = "rgba(78, 115, 223, 1)"; // Blue-ish alternating bar chart colors
        const cColor2 = "rgba(104, 135, 227, 1)"; // Blue-ish alternating bar chart colors
        
        const dColor = "rgba(230, 138, 0, 1)"; // Orangey alternating bar chart colors
        const dColor2 = "rgba(255, 163, 26, 1)"; // Orangey alternating bar chart colors
       
       //** Graph Covid Cases In the UK | START
        cConfig = new ChartConfigSetup(result.data); //* Updated way of doing things
        cConfig.getGraphLabels("date");
        cConfig.getGraphData1("cases");
        cConfig.getGraphData2("cases_today");
        //c_extra_config = {label:"Total Cases", labels:caseslabels, data_array:casesdata, todaydata:casestodaydata};
        //cConfig.label = "Total Cases";
        cConfig.dataExtraConfig({label:"Total Cases"}); //  labels data_array todaydata

        drawChartData(cConfig,"covidCasesChart");
        
        //** Graph Covid Cases In the UK | END
        //////////////////////////////////////
        //** Graph: Cases Last Seven Days | START
        
        const start_item = (result.data.length -7);
        c7Config = new ChartConfigSetup(result.data); //* Updated way of doing things
        c7Config.getGraphLabels("date", start_item);
        c7Config.getGraphData2("cases", start_item);
        c7Config.getGraphData1("cases_today",start_item);

        c7Config.dataExtraConfig({label:"Cases for day", extratotal_label:"Total to date", type: "bar", 
            backgroundColor:[cColor, cColor2, cColor, cColor2, cColor, cColor2, cColor]}); //  labels data_array todaydata
            
        drawChartData(c7Config,"casesSevenDays");       
        //** Graph: Cases Last Seven Days | END

        //////////////////////////////////////
        //** Graph: Average Weekly Cases trend | START
        const av_start_item = (result.data.length -15);
        const loop_step = 7;
        cAvgWeek = new ChartConfigSetup(result.data); //* Updated way of doing things
        cAvgWeek.getGraphAveragesLabels("date", av_start_item, loop_step);
        cAvgWeek.getGraphAveragesData("cases_average", av_start_item, loop_step);
        //cAvgWeek.getGraphData1("cases_today",start_item);

        cAvgWeek.dataExtraConfig({label:"Average"}); //  labels data_array todaydata
            
        drawChartData(cAvgWeek,"weeklyAverageCasesTrendChart");       
        //** Graph: Average Weekly Cases trend | END
        
        //////////////////////////////////////
        
        //** Graph Covid Expired In the UK | START
        dConfig = new ChartConfigSetup(result.data); //* Updated way of doing things
        dConfig.getGraphLabels("date");
        dConfig.getGraphData1("expired");
        dConfig.getGraphData2("expired_today");

        dConfig.dataExtraConfig({label:"Total Deaths", borderColor:dColor, pointBorderColor:dColor, pointBackgroundColor:dColor}); //  labels data_array todaydata
            
        drawChartData(dConfig,"covidDeathsChart");
        
        //** Graph Covid Expired In the UK | END
        //////////////////////////////////////
        //** Graph: Expired Last Seven Days | START
        
        //start_item = (result.data.length -7);
        d7Config = new ChartConfigSetup(result.data); //* Updated way of doing things
        d7Config.getGraphLabels("date", start_item);
        d7Config.getGraphData2("expired", start_item);
        d7Config.getGraphData1("expired_today",start_item);

        d7Config.dataExtraConfig({label:"Deaths for day",extratotal_label:"Total to date", type: "bar", 
            backgroundColor:[dColor, dColor2, dColor, dColor2, dColor, dColor2, dColor]}); //  labels data_array todaydata
            
        drawChartData(d7Config,"deathsSevenDays");       
        //** Graph: Expired Last Seven Days | END
        
        ///////////////////////////////////////
        //** Graph: Average Weekly Expired trend | START

        dAvgWeek = new ChartConfigSetup(result.data); //* Updated way of doing things
        dAvgWeek.getGraphAveragesLabels("date", av_start_item, loop_step);
        dAvgWeek.getGraphAveragesData("expired_average", av_start_item, loop_step);
        //cAvgWeek.getGraphData1("cases_today",start_item);

        dAvgWeek.dataExtraConfig({label:"Average",borderColor:dColor, pointBorderColor:dColor2, pointBackgroundColor:dColor}); //  labels data_array todaydata
            
        drawChartData(dAvgWeek,"weeklyAverageExpiredTrendChart");       
        //** Graph: Average Weekly Expired trend | END        
        ///////////////////////////////////////
        //** Pie chart: Monthly total cases for six months | START
        
        cSixMonths = new ChartConfigSetup(result.data); //* Updated way of doing things

        cSixMonths.getSixIndividualMonthsData("cases_today");
       
        cSixMonths.dataExtraConfig({label:"Cases per month", type: "pie"}); //  labels data_array todaydata
        
        cSixMonths.setDataSettings(casesPieChartData(cSixMonths)) ; 
        cSixMonths.setOptionsSettings(casesPieChartOptions());
        
        drawChartData(cSixMonths,"monthlyCasesTotalsSixMonth"); 
        
        //** Pie chart: Monthly total cases for six months | END
        
        setGraphCardLinks(); // Create links dynamically on the Graph display card menu
        
        //console.log(cSixMonths.getMonthTotalToDate('date'));
        //console.log(cSixMonths.getAlertMessages());
        alertsCenterList(cSixMonths.getAlertMessages());

    }, "json");

});

function alertsCenterList(messages)
{
    // id-s alerts-center-count alerts-center-items alerts center
    let items = document.getElementById("alerts-center-items").innerHTML;
    //console.log(items);
    document.getElementById("alerts-center-count").innerHTML = messages.alert_data_length;
    if(messages.latest_cases !== undefined)
    {
        var message = "There have been " + number_format(messages.latest_cases[0]) + " cases so far this month.";
        items += alertsCenterListPopulate(messages.latest_cases[1] ,message);
    }
    
    if(messages.latest_deaths !== undefined)
    {
        var message = "There have been " + number_format(messages.latest_deaths[0]) + " deaths in the current reporting month.";
        items += alertsCenterListPopulate(messages.latest_deaths[1] ,message, "fa-exclamation", "bg-warning");
    }
    if(messages.days_since_update !== undefined)
    {
        items += alertsCenterListPopulate(messages.days_since_update[1] ,messages.days_since_update[0], "fa-clock", "bg-danger");
    }
    document.getElementById("alerts-center-items").innerHTML = items;
    //console.log(items);
}

function alertsCenterListPopulate(date,message,icon, icon_color)
{
    icon = (icon === undefined)? "fa-file-alt": icon;
    icon_color = (icon_color === undefined)? "bg-primary": icon_color;
    
    var string = '<a class="dropdown-item d-flex align-items-center" href="#">';
    string +='<div class="mr-3">';
     string +='<div class="icon-circle ' + icon_color + '"><i class="fas ' + icon +' text-white"></i>';
     string +='</div>';
     string +='</div>';
     string += '<div>';
     string += '<div class="small text-gray-500">' + date + '</div>';
     string += '<span class="">' + message + '</span>';
     string +='</div>';
     return string += '</a>';
}

function casesPieChartData(chartObj)
{
    return {
        datasets: [{
            data: chartObj.graphData1,
            backgroundColor: ["rgb(230, 0, 50)","rgb(102, 140, 255)","rgb(217, 179, 255)", "rgb(179, 179, 179)", "rgb(0, 179, 0)", "rgb(255, 184, 51)"],
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: chartObj.labels,

    };    
}

function casesPieChartOptions()
{
    return {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
              legend: {
                position: 'top',
              },
              title: {
                display: true,
                text: 'Total cases per month'
              }
            },
            tooltips: {
                xPadding: 15,
              yPadding: 15,
                callbacks: {
                    label: (tooltipItem, chart)=> {
                        
                    returndisplay = new Array();
                    //console.log(chart.labels[tooltipItem.index]);
                    const label = chart.labels[tooltipItem.index] || '';
                    if(label !== "")
                    {
                        returndisplay[returndisplay.length] = label;
                    }
                    
                    returndisplay[returndisplay.length] = number_format(chart.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]);
                    // Return whatever is in the array (separated by ": " if length is 2 or on separate lines) as the tooltip label.
                    return (returndisplay.length === 2)?returndisplay.join(": "): returndisplay ; 

                }
              }
            }
          };
}

function setGraphCardLinks()
{
    const in_page_links = document.getElementsByClassName("in_page_link");
    var links_list = "";
    for(var i in in_page_links)
    {
        
        if(in_page_links[i].id !== undefined)
        {
            // Replace dashes in link name to formulate link title
            var label = in_page_links[i].id.replace(/\-/g, " ");
            // Capitalise all words in the link title (no 'php style' ucwords function in JavaScript).
            label = label.replace(/\w\S*/g, (w) => (w.replace(/^\w/, (c) => c.toUpperCase())));;
            links_list += '<a class="dropdown-item" href="#' + in_page_links[i].id +'">' + label + '</a>' + "\n";
        }
        
    }
    
    if(document.getElementsByClassName("stats-dropdown-menu")!== null)
    {
        const stats_dropdown = document.getElementsByClassName("stats-dropdown-menu");
        for (n in document.getElementsByClassName("stats-dropdown-menu") )
        {
            stats_dropdown[n].innerHTML = stats_dropdown[n].innerHTML + links_list;
        }
    }
    
    //console.log(links_list);
}
//
//function calcGraphAveragesData(array, object_name)
//{       
//        const avstart = (array.length < 15)? array.length: 15;
//        const return_array = new Array();
//        for(var n = (array.length - avstart); n < (array.length); n+=7)
//        {
//            return_array[return_array.length] =  array[n][object_name];
//        }
//        //console.log(return_array);
//        return return_array;
//}
//const isObject = (obj) => {
//    return Object.prototype.toString.call(obj) === '[object Object]';
//};


//* Draw the chart once all parameters have been set for each graph.
function drawChartData(chartConfig, chartname, extra_data)
{
    if(document.getElementById(chartname)!== null)
    {
        var ctx = document.getElementById(chartname);
        new Chart(ctx, chartConfig.config());         
    }    
}  
/**
 * Create the settings for each graph that can be easily edited before the graph is drawn ...
 * ... by calling a new chart class and sending this classes data() method in the process.
 * This process makes things easier, avoiding drilling down through chart config object levels.
 * @type void
 */
class ChartConfigSetup
{  
    constructor(result_data){

        //this.extraData = extra_data;
        this.labels_array = [];
        this.result_data = result_data;
        
        this.optionsSettings; // use with setConfigSettings/setConfigSettingsItem etc. methods
        this.dataSettings; // use with setDataSettings/setDataSettingsItem etc. methods
        //console.log("this.configOptions: " + this.configOptions);
        //this.data = {};
        
        this.graphData1 = [];
        this.graphData2 = [];
        this.averages_array = [];
        
        this.extratotal_label;
        //* Set defaults for the main chart visual look and data controls
        this.type = "line";
        this.labels = [];
        this.label = "my label";
        this.lineTension = 0.3;
        this.backgroundColor = "rgba(78, 115, 223, 0.05)";
        this.borderColor = "rgba(78, 115, 223, 1)";
        this.pointRadius = 3;
        this.pointBackgroundColor = "rgba(78, 115, 223, 1)";
        this.pointBorderColor = "rgba(78, 115, 223, 1)";
        this.pointHoverRadius = 3;
        this.pointHoverBackgroundColor = "rgba(78, 115, 223, 1)";
        this.pointHoverBorderColor = "rgba(78, 115, 223, 1)";
        this.pointHitRadius = 10;
        this.pointBorderWidth = 2;
        //this.data_array = [];
        //this.todaydata =[];// Colin's custom entry
    }
    
    getAlertMessages()
    {
        const messages = {};
        messages.latest_cases = this.getMonthTotalToDate("cases_today");
        messages.latest_deaths = this.getMonthTotalToDate("expired_today");
        const days_since_update = this.getDaysSinceDataUpdate();
        //console.log("days_since_update: " + days_since_update);
        if(Number.isInteger(days_since_update) && days_since_update > 0){
            let day_string = (days_since_update === 1)? "day": "days";
            messages.days_since_update = ["It has been " + days_since_update + " " + day_string + " since the last data update", new Date().toDateString()];
        }
        //console.log("Days since data update: " + this.getDaysSinceDataUpdate());
        //console.log("The getAlertMessages() length is: " + Object.keys(messages).length);
        messages.alert_data_length = Object.keys(messages).length;
        return messages;
    }
    
    getDaysSinceDataUpdate()
    {
        //console.log("getDataUpdateDays():" + this.getComputerDateFormat());
        const today_date = this.getComputerDateFormat();
        const last_update = this.getLastDataUpdate();
        const diffInMs   = new Date(today_date) - new Date(last_update);
        return diffInMs / (1000 * 60 * 60 * 24);

    }
    /**
     * Get the date that the last record refers to in string form
     * @returns {ChartConfigSetup.result_data.date}
     */
    getLastDataUpdate()
    {
        return this.result_data[this.result_data.length -1].date;
    }
    
    getComputerDateFormat(dayoffset)
    {
        //console.log("dayoffset: " + dayoffset);
        let t = new Date();
        if(dayoffset !== undefined && dayoffset.isInteger())
        {
            t = new Date().getDate() - dayoffset;
        }
        
        return t.getFullYear() + "-" + this.getFormattedMonthNumeric(t) + "-" + t.getDate();        
    }
    
    getFormattedMonthNumeric(date)
    {
        //if(date.isNumeric())
        return  ('0' + (date.getMonth()+1)).slice(-2);
    }
    
    getMonthTotalToDate(label)
    {
        const last_item_num = (this.result_data.length-1);
        const first_item_num = (this.result_data.length-7);
        const last_item = this.result_data[last_item_num];
        const latest_date = new Date(last_item['date']);
        //console.log("Latest:");
        //console.log("Date: " + last_item['date']);
        //console.log(latest_date);
        var total = 0;
        for(var i = first_item_num; i<= last_item_num; i++)
        {
            //console.log("Adding total for '" + label + "' (" + this.result_data[i][label] + ") on day " + i + " - Date: " + this.result_data[i].date) ;
            total += parseInt(this.result_data[i][label]);
        }
        
        return [total, latest_date.toDateString()];
        
        
    }
    
    getSixIndividualMonthsData(object_label)
    {
        //const casesmonth = {};
        //console.log("this.result_data for " + object_label);
        //console.log(this.result_data);
        for(var i = 1; i < 7; i++)
        {
            var tot = 0;
            //var dtset = new Date().setMonth(new Date().getMonth()-i);
            const last_record_date = this.result_data[this.result_data.length-1].date; // Get the date of the last record to base the six months data calc on
            var dtset = new Date(last_record_date).setMonth(new Date().getMonth()-i);
            var dt = new Date(dtset);
            
            //console.log("getSixIndividualMonthsData start date:");
            //console.log(dt);
            
            var date_match = dt.getFullYear() + "-" + this.getFormattedMonthNumeric(dt);

            for(var n in this.result_data)
            {
                var cd = new Date(this.result_data[n].date);
                //console.log(this.result_data[n].date);
                //var dateeval = cd.getFullYear() + "-" + (cd.getMonth()+1);
                var dateeval = cd.getFullYear() + "-" + this.getFormattedMonthNumeric(cd);
                if(dateeval === date_match)
                {
                    //"Date match on " + this.result_data[n].date;
                    tot += parseInt(this.result_data[n][object_label]); //** SOLVE LIVE SERVER JSON ENCODING OF AJAX CALL DATA BEFORE REMOVING parseInt FUNCTION

                }

            }

            //casesmonth[dt.toLocaleString('en-GB', {year:'numeric', month:'long'})] = tot;
            this.labels[this.labels.length] = dt.toLocaleString('en-GB', {year:'numeric', month:'long'});
            this.graphData1[this.graphData1.length] = tot;
        }
        
        //console.log("DEBUG Function: getSixIndividualMonthsData( ..) : casesmonth");
        //console.log(casesmonth);
    }
    
    getGraphAveragesLabels(object_label, start_array_item, loop_step)
    {
        this.labels = this.getGraphAveragesItem(object_label, start_array_item, loop_step);
    }  
    
    getGraphAveragesData(object_label, start_array_item, loop_step)
    {
        this.graphData1 = this.getGraphAveragesItem(object_label, start_array_item, loop_step);
    }   
    
    getGraphAveragesItem(object_name, start_array_item, loop_step)
    {       
        start_array_item = (start_array_item === undefined)? 0: start_array_item;
        //const avstart = (this.data_array.length < start_array_item)? this.data_array.length: start_array_item;
        //console.log("start_array_item: " + start_array_item);
        //console.log("loop_step: " + loop_step);
        var graphdata = new Array();
        for(var n = start_array_item; n < this.result_data.length; n+= loop_step)
        {
            graphdata[graphdata.length] =  this.result_data[n][object_name];
        }
            //console.log(return_array);
        return graphdata;
    } 
    
    getGraphLabels(object_label, start_array_item)
    {
        //console.log(this.result_data);
        this.labels = this.getGraphData(object_label,start_array_item);
    }
    
    getGraphData1(object_label,start_array_item)
    {
        //console.log(this.result_data);
        this.graphData1 = this.getGraphData(object_label,start_array_item);
    }
    
    getGraphData2(object_label,start_array_item)
    {
        this.graphData2 = this.getGraphData(object_label,start_array_item);
    }
    
    getGraphData(object_label, start_array_item)
    {
       start_array_item = (start_array_item === undefined)? 0: start_array_item;
       //console.log("start_array_item: " + start_array_item);
       //var itemcount = 0;
       var graphdata = new Array();
       for(var i= start_array_item ; i < this.result_data.length; i++)
       {
           graphdata[graphdata.length] = this.result_data[i][object_label];

       } 
       
       return graphdata;
    }
    isObject(obj)
    {
        return Object.prototype.toString.call(obj) === '[object Object]';
    }
    
    //** Main Call when setting up chart. use setDataSettings...() and setOptionsSettings...() methods first, if necessary
    config()
    {
        return {
          type: this.type,
          //data: this.dataObject,
          data: this.getDataSettings(),
          options: this.getOptionsSettings()
          
        };
    };
    
    dataExtraConfig(extra_settings)
    {

        if(this.isObject(extra_settings))
        {
            for(var k in extra_settings)
            {
                this[k] = extra_settings[k];
            }
        }
    }
    setDataSettingsItem(item, settingsObject)
    {
        if(this.isObject(settingsObject))
        {
            this.dataSettings[item]= settingsObject;
        }
        
    }
    setDataSettings(object)
    {
        if(this.isObject(object))
        {
            this.dataSettings = object;
        }
        
    }     
    getDataSettings()
    {
        if(this.dataSettings ===  undefined)
        {
            //const data = {};
            
            return {
            labels: this.labels,
            datasets: [{
              label: this.label,
              lineTension: this.lineTension,
              backgroundColor: this.backgroundColor,
              borderColor: this.borderColor,
              pointRadius: this.pointRadius,
              pointBackgroundColor:this.pointBackgroundColor,
              pointBorderColor: this.pointBorderColor,
              pointHoverRadius: this.pointHoverRadius,
              pointHoverBackgroundColor: this.pointHoverBackgroundColor,
              pointHoverBorderColor: this.pointHoverBorderColor,
              pointHitRadius: this.pointHitRadius,
              pointBorderWidth: this.pointBorderWidth,
              data: this.graphData1,
              data2:this.graphData2, // For extra graph data
            }]

          };
        }
        
        return this.dataSettings;

    }

     
    setOptionsSettingsItem(item, settingsObject)
    {
        if(this.isObject(settingsObject))
        {
            this.optionsSettings[item]= settingsObject;
        }
        
    }
    setOptionsSettings(object)
    {
        if(this.isObject(object))
        {
            this.optionsSettings = object;
        }
        
    }    
    getOptionsSettings()
    {
        if(this.optionsSettings === undefined)
        {
            return this.defaultOptionsSettings(); // Return default if the options have not been set
        }
        return this.optionsSettings;
    }
    
    //* Default for if nothing was set before call from Chart.js class.
    defaultOptionsSettings()
    {
        //this.configSettings = {
        return {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
              padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
              }
            },
            scales: {
              xAxes: [{
                time: {
                  unit: 'date'
                },
                gridLines: {
                  display: false,
                  drawBorder: false
                },
                ticks: {
                  maxTicksLimit: 7
                }
              }],
              yAxes: [{
                ticks: {
                  maxTicksLimit: 5,
                  padding: 10,
                  // Include a dollar sign in the ticks
                  callback: function(value, index, values) {
                    //return '$' + number_format(value);
                    return value;
                  }
                },
                gridLines: {
                  color: "rgb(234, 236, 244)",
                  zeroLineColor: "rgb(234, 236, 244)",
                  drawBorder: false,
                  borderDash: [2],
                  zeroLineBorderDash: [2]
                }
              }]
            },
            legend: {
              display: false
            },
            tooltips: {
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#858796",
              titleMarginBottom: 10,
              titleFontColor: '#6e707e',
              titleFontSize: 14,
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              intersect: false,
              mode: 'index',
              caretPadding: 10,
              enabled:true,
              callbacks: {
                label: (tooltipItem, chart)=> {
                //console.log(chart.datasets[tooltipItem.datasetIndex].todaydata);
                  const datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                  //var todaytotal = "Day total: " + todaydata[tooltipItem.index] || '';
                  //console.log("extratotal_label: " + this.extratotal_label);
                  const extratotal_label = this.extratotal_label !== undefined ? this.extratotal_label + ": " : "Day total";
                  
                  const extra_total_value = (chart.datasets[tooltipItem.datasetIndex].data2[tooltipItem.index]) 
                  ? extratotal_label + ": " +number_format(chart.datasets[tooltipItem.datasetIndex].data2[tooltipItem.index]) : "";
                  
                  const extratotal = extra_total_value || '';
                  
                  // return array so that cumulative total and day total appear on separate lines.
                  return [datasetLabel + ': ' + number_format(tooltipItem.yLabel),extratotal] ;

                }//.bind(this) // important so that this.isObject(obj) can be seen by the callback (if not using arrow function). 
              }
            }
          };
    }

}

    </script>
@endsection

