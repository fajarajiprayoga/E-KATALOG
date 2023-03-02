<!DOCTYPE html>
<html>
<head>
    <style>
        .animate
        {
            height: 0px;
            transition: height 1s;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.png?3">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datepicker.css">
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/select2-master/dist/css/select2.min.css"> <!-- SELECT2 -->
  </head>
  <body>
      <?php if(isset(Yii::app()->user->id)){ ?>
      
        <header class="header">
            <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.html" class="navbar-brand font-weight-bold text-uppercase text-base">E-KATALOG</a>
              <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">

                <li class="nav-item dropdown ml-auto">
                    <img src="images/logodok.png" width="140px">
                </li>
              </ul>
            </nav>
        </header>
      
        <?php if(/*$this->cekotp()*/ '1' == '1'){ ?>
        <div class="d-flex align-items-stretch">
            <div id="sidebar" class="sidebar py-3">
              <?php if(Yii::app()->user->isAdm() || Yii::app()->user->isEng() || Yii::app()->user->isAll()){ ?>
              <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
              <ul class="sidebar-menu list-unstyled">
                    <li id="navhome" class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted dashboard"><i class="o-home-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
                    <li id="navmasterproduk" class="sidebar-list-item"><a style="cursor: pointer;" class="sidebar-link text-muted masterproduk"><i class="o-database-1 mr-3 text-gray"></i><span>Master Produk</span></a></li>
                    <li id="navmasterclass" class="sidebar-list-item"><a style="cursor: pointer;" class="sidebar-link text-muted masterclass"><i class="o-survey-1 mr-3 text-gray"></i><span>Master Class</span></a></li>
                    <li id="navmastermodel" class="sidebar-list-item"><a style="cursor: pointer;" class="sidebar-link text-muted mastermodel"><i class="o-wireframe-1 mr-3 text-gray"></i><span>Master Model</span></a></li>
                    <li id="navmastertype" class="sidebar-list-item"><a style="cursor: pointer;" class="sidebar-link text-muted mastertype"><i class="o-app-layout-1 mr-3 text-gray"></i><span>Master Type</span></a></li>
                    <li id="navmasterchasis" class="sidebar-list-item"><a style="cursor: pointer;" class="sidebar-link text-muted masterchasis"><i class="o-code-window-1 mr-3 text-gray"></i><span>Master Chasis</span></a></li>
                    <li class="sidebar-list-item"><a href="index.php?r=site/logout" class="sidebar-link text-muted"><i class="o-exit-1 mr-3 text-gray"></i><span>Logout</span></a></li>
              </ul>
              <?php } else if(Yii::app()->user->isSales()){ ?>
              <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
              <ul class="sidebar-menu list-unstyled">
                    <li class="sidebar-list-item"><a href="index.php?r=home" class="sidebar-link text-muted"><i class="o-home-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
                    <li class="sidebar-list-item"><a style="cursor: pointer;" class="sidebar-link text-muted masterchasis"><i class="o-code-window-1 mr-3 text-gray"></i><span>Master Chasis</span></a></li>
                    <li class="sidebar-list-item"><a href="index.php?r=site/logout" class="sidebar-link text-muted"><i class="o-exit-1 mr-3 text-gray"></i><span>Logout</span></a></li>
              </ul>
              <?php }?>
            </div>
            <div class="page-holder w-100 d-flex flex-wrap">
                
                
                <div class="container-fluid px-xl-5">
                    <div class="loader">
                        <img src="images/loader5.gif" style="position:absolute; margin:auto; top:0; left:0; right:0; bottom:0; z-index: 10000 !important;" width="90" alt="Loading">
                    </div>
                    <div class="" id="content">

                    </div>
                </div>
                
                
              <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-6 text-center text-md-left text-primary">
                      <p class="mb-2 mb-md-0">New Armada &copy; 2020</p>
                    </div>
                    <div class="col-md-6 text-center text-md-right text-gray-400">
                      <p class="mb-0">Design by <a href="https://bootstrapious.com/admin-templates" class="external text-gray-400">Bootstrapious</a></p>
                      <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                    </div>
                  </div>
                </div>
              </footer>
            </div>
        </div>
        <script>
        $(document).ready(function(){
            load_beranda();
            $('.dashboard').addClass('active');
        });
        </script>
        
        <?php } else { ?>
        
        <script>
        $(document).ready(function(){
            load_authotp();
        });
        </script>
        
        <?php } ?>
      
        <div class="container-fluid px-xl-5">
            <div class="loader">
                <img src="images/loader5.gif" style="position:absolute; margin:auto; top:0; left:0; right:0; bottom:0; z-index: 10000 !important;" width="90" alt="Loading">
            </div>
            <div class="" id="content">

            </div>
        </div>
        
      <?php } else { ?>
      <?php echo $content; ?>
      <?php } ?>
    <!-- DATEPICKER -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.min.js"></script>
    <!-- DATEPICKER -->
    
    <!-- JavaScript files-->
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
    
    <script src="ajax/function.js"></script>
    <script src="ajax/onklik.js"></script>
    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/select2-master/dist/js/select2.min.js"></script>

  </body>
</html>