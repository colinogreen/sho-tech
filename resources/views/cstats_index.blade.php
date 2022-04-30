<?php
//use Classes\Sessions\Session;

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
                <a class="nav-link" href="{{ route("site_index") }}">
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
                               
                            </div>
                        </li>
                       
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
                <div class="container-fluid cstats_headline">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Covid Statistics for the UK</h1>
                        <p style="font-style:italic">Information provided by <a href="https://coronavirus.data.gov.uk" target="_blank">https://coronavirus.data.gov.uk</a></p>
                       <?php /* <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> */ ?>
                    </div>

                    <!-- Content Row -->
                    <div class="row stats_row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total cases to date: <span id="total_cases_to_date_date"></span> 
                                                </div>
                                            <div id="" class="h5 mb-0 font-weight-bold text-gray-800"><span id="total_cases_to_date" class="">Please wait ...</span>
                                            <span class="info_colour">                                            
                                                <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" 
                                                         title="Reported cases in total to the last update date."></i>
                                            </span>
                                            </div>

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
                                                Total Deaths to date: <span id="total_deaths_to_date_date"></span>
                                            </div>
                                            <div id="" class="h5 mb-0 font-weight-bold text-gray-800"><span id="total_deaths_to_date">Calculating ... </span>
                                                <span class="info_colour"><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" 
                                                         title="Reported deaths in total to the last update date."></i></span>
                                            
                                            </div>
                                                        
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

                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Cases for <span id="total_cases_for_date_date"></span>
                                                  
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div id="" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <span id="total_cases_for_date">Calculating... </span>
                                                     <span class="info_colour">  
                                                         <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top"                                  
                                                            title="Reported cases for the last update day. This does not necessarily match with total cases to date today minus total cases to date yesterday."></i>   </span>                                                    
                                                    </div>
                                                   
                                                </div>
                                                <div class="col">

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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="average_weekly_cases_date">Please wait ...</span>
                                                <span class="info_colour">
                                                    <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" 
                                                         title="Average cases for the week is based on the reported cases totals for the last reporting day and the cases reported
                                                    on six previous days."></i> 
                                                </span>
                                            </div>
                                            
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

                    <div class="row stats_row">

                        <!-- Area Chart -->
                        <div id="covid-cases-in-uk" class="in_page_link col-xl-6 col-lg-5">
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
                        <div id="covid-cases-in-last-seven-days" class="in_page_link col-xl-3 col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Covid Cases - Last Seven Days</h6>
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
                        <div id="average-weekly-cases-trend" class="in_page_link col-xl-3 col-lg-3">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Average Weekly Cases Trend</h6>
                                    
                                   
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
                    <div class="row stats_row">
                        
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
                        <div id="covid-deaths-in-last-seven-days" class="in_page_link col-xl-3 col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Covid Deaths - Last Seven Days</h6>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Average Weekly Deaths Trend</h6>

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
                        <div id="total-cases-per-month" class="in_page_link col-xl-5 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Total Cases Per Month (last six)</h6>
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
    document.addEventListener('DOMContentLoaded', function () {
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  });
  
  // * Debugging function activated inside ajax result .done processing.
 function testingFunction(result)
 {
    //console.log(window.location.href);
//    if( window.location.href === "http://sho.technohelp.vm2/cstats")
//    {
//        inline_msg = "+'Inline script'+: ";
//        if(result.message !== undefined && result.message !== null)
//        {
//             //console.log(inline_msg +"Data Last Modified: "); console.log(result.last_modified);
//
//             //console.log(inline_msg +"Date Difference Calc:\n");  today_date = "2021-10-28 15:00:00"; const diffInMs = new Date(today_date) - new Date(result.last_modified);  console.log("Days diff between '"+ today_date + "' and '"+ result.last_modified +"' = " + diffInMs / (1000 * 60 * 60 * 24));
//             console.log("result: "); console.log(result);          
//         } 
//         // **Fix function in ChartConfigSetup class (chartconfigsetup.js)
//         getSixIndividualMonthsData_test(result);
//    }


 }
    // **Fix function in ChartConfigSetup class (chartconfigsetup.js)
    function getSixIndividualMonthsData_test(result)
    {
        console.log("== START - getSixIndividualMonthsData_test(result) INLINE JS ChartConfigSetup.getSixIndividualMonthsData_test DEBUG ==");
        console.log("== START - getSixIndividualMonthsData_test(result) INLINE JS ChartConfigSetup.getSixIndividualMonthsData_test DEBUG ==");
        object_label = "cases_today";
        var debuglabels = new Array();
        var debuggraphData1 = new Array();
        
        var prevmonth; // Helps reduce month to previous month under certain circumstances
        for(var i = 1; i < 7; i++)
        {
            var tot = 0;
            //var dtset = new Date().setMonth(new Date().getMonth()-i);
            const last_record_date = result.message[result.message.length-1].date; // Get the date of the last record to base the six months data calc onz
            
            var ldate = new Date(last_record_date);
            //var ldate = new Date("2021-04-01");
            //console.log("-- Last record date: " + ldate + " - Current month = "+ (ldate.getMonth()) + " - Month - 1 = " + (ldate.getMonth()-i) +" --\n");
            ldate.setMonth(ldate.getMonth()-i, 1);
            console.log("-- New record date: " + ldate  +" --\n");
            
            
            // If reduction of months still results in the same month being shown, reduce to previous month.
            if(ldate.getMonth() === prevmonth)
            {
                ldate.setDate(0);
                console.log("-- ldate.getMonth() === prevmonth: " + ldate.getMonth() + "\n");
            }
            //console.log("-- ldate.setMonth(ldate.getMonth()-i): " + ldate + "\n");
            
            prevmonth = ldate.getMonth();

            var date_match = ldate.getFullYear() + "-" + getFormattedMonthNumeric_test(ldate);

            for(var n in result.message)
            {
                var cd = new Date(result.message[n].date);

                var dateeval = cd.getFullYear() + "-" + getFormattedMonthNumeric_test(cd);
                if(dateeval === date_match)
                {
                    tot += parseInt(result.message[n][object_label]); //** SOLVE LIVE SERVER JSON ENCODING OF AJAX CALL DATA BEFORE REMOVING parseInt FUNCTION

                }

            }

            debuglabels[debuglabels.length] = ldate.toLocaleString('en-GB', {year:'numeric', month:'long'});
            debuggraphData1[debuggraphData1.length] = tot;
        }
        console.log(debuglabels);
        console.log(debuggraphData1);
        console.log("== END - getSixIndividualMonthsData_test(result)  ==");


    }
    
    function getFormattedMonthNumeric_test(date)
    {
        return  ('0' + (date.getMonth()+1)).slice(-2);
    }
</script>
@endsection

