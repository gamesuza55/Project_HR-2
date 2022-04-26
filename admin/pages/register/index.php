<?php
session_start();
require('../../conn.php');
require_once('../../config.php');

if($_SESSION['status'] != 'admin') {
  header('location:../../index.php');

  exit;
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
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">
    <!-- lightbox 2 -->
    <link href="../../dist/css/lightbox.min.css" rel="stylesheet" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/iCheck/all.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
-->

<body class="hold-transition skin-blue fixed sidebar-mini">
  <div class="wrapper">

   <?php 
   $page = "register_add";
   require_once('../../header.php');
   require_once('../../aside.php');
   ?>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ตารางการลาของพนักงาน
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php PATH; ?>/project/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">เพิ่มสมาชิก</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">เพิ่มสมาชิก</h3>
              <hr style="border-top:1px solid #d7d7d7!important;" />
              <?php include_once('view/register_form.php'); ?>
            </div>
            <div class="box-body">

            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  <!-- /.content-wrapper -->



  <?php
  require_once('../../footer.php'); 
  require_once('../../aside_control.php'); 
  ?>

  

  <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->


  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- lightbox 2 -->
  <script src="../../dist/js/lightbox-plus-jquery.js"></script>
  <!-- jQuery 3 -->
  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Select2 -->
  <script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- DataTables -->
  <script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../../bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- bootstrap datepicker -->
  <script src="../../bower_components/bootstrap-datepicker/js/bootstrap-datepicker-thai.js"></script>
  <script src="../../bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js"></script>
  <!-- bootstrap color picker -->
  <script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="../../plugins/iCheck/icheck.min.js"></script>
  <!-- InputMask -->
  <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
</body>
</html>
<script>

</script>
<script>
  $('#open_pass').click(function(){
    if('password' == $('#password').attr('type')){
     $('#password').prop('type', 'text');
   }else{
     $('#password').prop('type', 'password');
   }
 });
</script>
<script>
  $("form#register_form").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);

//      console.log(data)
//         if(data == 'success') {
//           Swal.fire({
//             position: 'top-end',
//             type: 'success',
//             title: 'เพิ่มข้อมูลสำเร็จ',
//             showConfirmButton: false,
//             timer: 1500

//           }),setTimeout(function(){location.href="register_staff.php"} , 1000);   
//           $("form#register_form")[0].reset();
//         } else if(data == 'error') {
//           Swal.fire({
//             position: 'top-end',
//             type: 'error',
//             title: 'username ซ้ำกันครับ',
//             showConfirmButton: false,
//             timer: 1500
//           })

// 

$.ajax({
  url: 'view/insert_register.php',
  type: 'POST',
  data: formData,
  success: function (data) {

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ใช่',
      cancelButtonText: 'ไม่'
    }).then((result) => {
      if (result.isConfirmed) {
        if(data == 'success') {
          console.log(data)
          Swal.fire({
            title: 'เพิ่มข้อมูลสำเร็จ!',
            icon: 'success'
            }),setTimeout(function(){location.href="register_staff.php"} , 1000); 
        } else if(data == 'error') {
          Swal.fire({
            icon: 'error',
            title: 'username ซ้ำกันครับ',
            showConfirmButton: false
          })
        }
      }
    })
  },
  cache: false,
  contentType: false,
  processData: false
});
});
</script>
<script>
//Date picker
$('.datepicker').datepicker({
  format: "yyyy-mm-dd",
  todayHighlight: true,
  autoclose: true,
  todayBtn: "linked",
  language: 'th',
  isBuddhist: true,
})
</script>
<script>
//Date picker
$('#datepicker_edit').datepicker({
  format: "yyyy-mm-dd",
  todayHighlight: true,
  autoclose: true,
  todayBtn: "linked",
  language: 'th',
  isBuddhist: true,
})
</script>
<script>
//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
})
</script>
<script>
  $(function () {
    $('.select2').select2()

    $('[data-mask]').inputmask()
  })
</script>

