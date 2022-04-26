  <?php
  session_start();
  require_once('config.php');
  require('conn-main.php');
  if(($_SESSION['status'] ?? false) != 'admin') {
    header('location:../index.php');

    exit;
  }

  function DateThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear" ;/*, $strHour:$strMinute";*/
  }



  ?>
  <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
  .loading {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(image/loader-128x/Preloader_2.gif) center no-repeat #fff;
  }
  .lds-spinner {
    color: official;
    display: inline-block;
    position: relative;
    width: 64px;
    height: 64px;
  }
  .lds-spinner div {
    transform-origin: 32px 32px;
    animation: lds-spinner 1.2s linear infinite;
  }
  .lds-spinner div:after {
    content: " ";
    display: block;
    position: absolute;
    top: 3px;
    left: 29px;
    width: 5px;
    height: 14px;
    border-radius: 20%;
    background: #fdd;
  }
  .lds-spinner div:nth-child(1) {
    transform: rotate(0deg);
    animation-delay: -1.1s;
  }
  .lds-spinner div:nth-child(2) {
    transform: rotate(30deg);
    animation-delay: -1s;
  }
  .lds-spinner div:nth-child(3) {
    transform: rotate(60deg);
    animation-delay: -0.9s;
  }
  .lds-spinner div:nth-child(4) {
    transform: rotate(90deg);
    animation-delay: -0.8s;
  }
  .lds-spinner div:nth-child(5) {
    transform: rotate(120deg);
    animation-delay: -0.7s;
  }
  .lds-spinner div:nth-child(6) {
    transform: rotate(150deg);
    animation-delay: -0.6s;
  }
  .lds-spinner div:nth-child(7) {
    transform: rotate(180deg);
    animation-delay: -0.5s;
  }
  .lds-spinner div:nth-child(8) {
    transform: rotate(210deg);
    animation-delay: -0.4s;
  }
  .lds-spinner div:nth-child(9) {
    transform: rotate(240deg);
    animation-delay: -0.3s;
  }
  .lds-spinner div:nth-child(10) {
    transform: rotate(270deg);
    animation-delay: -0.2s;
  }
  .lds-spinner div:nth-child(11) {
    transform: rotate(300deg);
    animation-delay: -0.1s;
  }
  .lds-spinner div:nth-child(12) {
    transform: rotate(330deg);
    animation-delay: 0s;
  }
  @keyframes lds-spinner {
    0% {
      opacity: 1;
    }
    100% {
      opacity: 0;
    }
  }

</style>
<!-- Main Header -->

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
-->

<body class="hold-transition skin-blue fixed sidebar-mini" onload="FunctionShowData();">
  <?php if(isset($_POST['search_mounth'])) {?>
  <?php } else {?>
    <div class="loading"></div>
  <?php } ?>
  <div class="wrapper">

   <?php 

   require_once('header.php'); 
   $page = "dashboard";

   require_once('aside.php'); 
   ?>


   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        รายงานสรุป
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php PATH; ?>/project/"><i class="fa fa-dashboard"></i>รายการสรุป</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <?php require('conclude.php'); ?>
      </div>
      <div class="row">
        <div class="col-md-7">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">การลางานของพนักงาน ล่าสุด</h3>
            </div>
            <!-- body box start -->
            <div class="box-body">
              <?php require('db_tablestaff.php'); ?>
            </div>
          </div>
        </div>

        <!-- /col-md-6 1  -->
        <div class="col-md-5">
          <div class="box box-success">
            <div class="box-header with-border">
              <div class="row">
                <div class="col-md-6">
                  <h3 class="box-title">สรุปการลาของพนักงาน 

                  </h3>
                </div>
                <div class="col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="search_date">
                    <select name="search_year" id="search_year" class="custom-select pull-right " style="width:50%;" onchange="search_date.submit();">
                      <option value="กรุณาเลือกข้อมูล" disabled selected>กรุณาเลือกข้อมูล</option>
                      <option value="<?php echo date('Y'); ?>"  <?php if(isset($_POST['search_year']) == date('Y')) { echo "selected"; } ?>>ปีปัจจุบัน</option>
                      <option value="all" <?php if(isset($_POST['search_year']) == 'all') { echo "selected"; } ?>>ทั้งหมด(ปี)</option>
                      <?php
                      $currently_selected = date('Y');
                      $earliest_year = 2010; 
                      $latest_year = date('Y'); 
                      foreach ( range( $latest_year, $earliest_year ) as $i ) {
                        $date_thai  = $i + 543;
                        ?>
                        <option value="<?php echo $i; ?>" <?php if(@$_POST['search_year'] == $i) { echo "selected";} ?>><?php echo $date_thai; ?></option>';
                        // 
                        <?php
                      } 

                      ?>
                    </select>
                    <select name="search_mounth" id="search_mounth" class="custom-select pull-right " style="width:50%" onchange="search_date.submit(); ">
                    <option value="กรุณาเลือกข้อมูล" disabled selected>กรุณาเลือกข้อมูล</option>
                      <option value="<?php echo date('m'); ?>"  <?php if(isset($_POST['search_mounth']) == date('m')) { echo "selected"; } ?> >เดือนปัจจุบัน</option>
                      <option value="all" <?php if(@$_POST['search_mounth'] == 'all') { echo "selected"; } ?>>ทั้งหมด(เดือน)</option>
                      <option value="01"   <?php if(@$_POST['search_mounth'] == '01') { echo "selected"; } ?>>มกราคม</option>
                      <option value="02"   <?php if(@$_POST['search_mounth'] == '02') { echo "selected"; } ?>>กุมภาพันธ์</option>
                      <option value="03"   <?php if(@$_POST['search_mounth'] == '03') { echo "selected"; } ?>>มีนาคม</option>
                      <option value="04"   <?php if(@$_POST['search_mounth'] == '04') { echo "selected"; } ?>>เมษายน</option>
                      <option value="05"   <?php if(@$_POST['search_mounth'] == '05') { echo "selected"; } ?>>พฤษภาคม</option>
                      <option value="06"   <?php if(@$_POST['search_mounth'] == '06') { echo "selected"; } ?>>มิถุนายน</option>
                      <option value="07"   <?php if(@$_POST['search_mounth'] == '07') { echo "selected"; } ?>>กรกฏาคม</option>
                      <option value="08"   <?php if(@$_POST['search_mounth'] == '08') { echo "selected"; } ?>>สิงหาคม</option>
                      <option value="09"   <?php if(@$_POST['search_mounth'] == '09') { echo "selected"; } ?>>กันยายน</option>
                      <option value="10"   <?php if(@$_POST['search_mounth'] == '10') { echo "selected"; } ?>>ตุลาคม</option>
                      <option value="11"   <?php if(@$_POST['search_mounth'] == '11') { echo "selected"; } ?>>พฤศจิกายน</option>
                      <option value="12"   <?php if(@$_POST['search_mounth'] == '12') { echo "selected"; } ?>>ธันวาคม</option>
                    </select>
                  </form>
                </div>
              </div>
              

            </div>
            <!-- body box start -->
            <div class="box-body">
              <?php require('db_tablereport.php'); ?>

            </div>
          </div>
        </div>
        <!-- /col-md-6 1  -->

      </div>
      <!-- /row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <?php
  require_once('footer.php'); 
  require_once('aside_control.php'); 
  ?>



  <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->


  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src="plugins/LoadMore/jquery.simpleLoadMore.js"></script>
  <script>
    $('.some-list-report').simpleLoadMore({
      item: 'li',
      count: 5,
      itemsToLoad: 5
    });
    $('.some-list-staff').simpleLoadMore({
      item: 'tr',
      count: 10,
      itemsToLoad: 5
    });

  </script>
  <!-- jQuery3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->

  <script src="dist/js/demo.js"></script>

  <!-- page script -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>




</body>
</html>

<script>

  function FunctionShowData() {
    setTimeout(showData, 600);
  }

  function showData() {

    $('.lds-spinner').hide();
    $('.ShowData').show();
  }
</script>
<!-- function showPage() {
$('.lds-spinner').css('display', 'none');
$('.product-list-in-box').css('display', 'block');
}
var myVar;

function loadingData() {
myVar = setTimeout(showPage, 3000);
} -->


<script>
  $.noConflict();
  jQuery(window).load(function() {

    $(".loading").fadeOut(1500);;
  });

</script>
