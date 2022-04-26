<?php
session_start();
require('../../../conn.php');
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

  <!-- lightbox 2 -->
  <link href="../../dist/css/lightbox.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

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
   $page = "register_staff";
   require_once('../../header.php');
   require_once('../../aside.php'); 
   ?>
   

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       พนักงาน
     </h1>
     <ol class="breadcrumb">
      <li><a href="<?php PATH; ?>/project/"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">พนักงาน</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">ตารางการลาของพนักงาน</h3>
          </div>
          <div class="box-body">

            <?php require_once('view/table_staff.php'); ?>

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

<!-- lightbox 2 -->
<script src="../../dist/js/lightbox-plus-jquery.js"></script>
<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
<!-- DataTable script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
</body>
</html>
<script>
$('.del_user').click(function(e) {
  e.preventDefault();    
  /* Act on the event */
  var username = $(this).attr('data-user');

  $.confirm({
   title: 'ต้องการลบข้อมูลหรือไม่ ?',
   type: 'red',
   content: 'ข้อมูลในตารางจะหายไป <b class="text-danger">DELETE</b> ยกเลิกคำสั่ง <b></b>',
   autoClose: 'ยกเลิก|8000',
   buttons: {
    deleteUser: {
      text: 'ลบข้อมูล',
      btnClass: 'btn-red',
      action: function () {
        $.alert({
          title:'ลบข้อมูลเรียบร้อยแล้ว!',
          type: 'green',
          content: false,
        }),
        $.ajax({
          url: 'view/delete_user.php',
          type: 'POST',
          data: {username: username},
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });

      }
    },
    ยกเลิก: function () {
      $.alert({
        title:false,
        type: 'red',
        content:'ยกเลิกการลบข้อมูล',
        buttons: {
          OK: {
            text: 'ตกลง',
            btnClass: 'btn-red',
          }
        }
      });
    }
  }
});


  
});
</script>
<script>
$('#example1').DataTable({
  "bLengthChange": false,
  "pageLength": 5,
  "language": {
    "sEmptyTable":     "ไม่มีข้อมูลในตาราง",
    "sInfo":           "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
    "sInfoEmpty":      "แสดง 0 ถึง 0 จาก 0 แถว",
    "sInfoFiltered":   "(กรองข้อมูล _MAX_ ทุกแถว)",
    "sInfoPostFix":    "",
    "sInfoThousands":  ",",
    "sLengthMenu":     "แสดง _MENU_ แถว",
    "sLoadingRecords": "กำลังโหลดข้อมูล...",
    "sProcessing":     "กำลังดำเนินการ...",
    "sSearch":         "ค้นหา: ",
    "sZeroRecords":    "ไม่พบข้อมูล",
    "oPaginate": {
      "sFirst":    "หน้าแรก",
      "sPrevious": "ก่อนหน้า",
      "sNext":     "ถัดไป",
      "sLast":     "หน้าสุดท้าย"
    },
    "oAria": {
      "sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
      "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
    }
  }
});

</script>
<script>
function myFunction() {
  var x = document.getElementById("Showpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

