<?php
session_start();
require_once('conn.php');
require_once('conn_main.php');
require_once('../config.php');

if((!$_SESSION['user']?? false)) {
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

$sql_user = mysqli_query($conn, "SELECT * FROM member WHERE username = '".$_SESSION['user']."' ");
$row_user = mysqli_fetch_assoc($sql_user);




$sql = "SELECT id, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Human Resource Management</title>
  <!-- Theme CSS -->
  <link href="css/freelancer.min.css" rel="stylesheet">
  <!-- Custom fonts for this theme -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Kanit:300&display=swap&subset=thai" rel="stylesheet"> 
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
  
  

  <!-- FullCalendar -->
  <link rel="stylesheet" href="css/fullcalendar.css ?>" >

  <!-- Css,Script Libary AOS animation -->
  <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
  
  <!-- DataTable -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Datepicker CSS -->
  <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />

  <!-- style.css -->
  <link rel="stylesheet" href="css/style.css">

  <!-- lightbox 2 -->
  <link href="dist/css/lightbox.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="dist/css/jquery-confirm.min.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/owl.theme.default.css">
  <style>
    body {
      font-family: 'Kanit','500', sans-serif;
    }
    #mainNav {
      font-family: 'Kanit',sans-serif;
      font-size: 18px;

    }
    .loading {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url(img/loader-128x/Preloader_7.gif) center no-repeat #fff;
    }
  </style>

</head>
<body id="page-top">
  <div class="loading"></div>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="img/brand/logo-01.png" alt="" height="50"> </a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['status']) && isset($_SESSION['department']) == "Accounting" ) { ?>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo PATH; ?>/payroll">ระบบบัญชี</a>
            </li>
          <?php  } ?>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">ระบบลาออนไลน์</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">พนักงาน</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">ปฏิทินวันหยุด</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Masthead -->
  <header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
      <div class="content">
        <img class="content-image mb-2 rounded-circle" src="../images/user/<?php echo $row_user['image_user']; ?>" data-aos="fade-up" height="250">
        <div class="content-overlay"></div>
        <div class="content-details fadeIn-top">
         <a href="edit_profile.php?user=<?php echo $_SESSION['user']; ?>" class="text-warning"> 
          <h4 class="text-warning">
            <i class="fas fa-camera-retro"></i>
            แก้ไขประวัติ
          </h4> 
        </a>
      </div>

    </div>
    <!-- Masthead Heading -->
    <h1 class="masthead-heading text-uppercase mt-5">ยินต้อนรับ</h1>

    <!-- Icon Divider -->
    <div class="divider-custom divider-light">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon">
        <i class="fas fa-star"></i>
      </div>
      <div class="divider-custom-line"></div>
    </div>

    <!-- Masthead Subheading -->
    <p class="masthead-subheading font-weight-light mb-0">Programer - Graphic Design - Accounting - Sales</p>
    <button type="submit" class="btn btn-danger btn-lg mt-3" id="log-out">ออกจาระบบ</button>

  </div>
</header>

<!-- Portfolio Section -->
<section class="page-section portfolio" id="portfolio">
  <div class="container" style="max-width:1145px;">
    <!-- Portfolio Section Heading -->
    <h1 class="page-section-heading text-center text-uppercase text-secondary mb-0">ระบบลาออนไลน์</h1>
    <!-- Icon Divider -->
    <div class="divider-custom">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon">
        <i class="fas fa-star"></i>
      </div>
      <div class="divider-custom-line"></div>
    </div>

    <!-- Portfolio Grid Items -->
    <div class="row text-center">

      <!-- Portfolio Item 1 -->
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-achor="bottom-center">
        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1" onclick="Datepicker1();" style="max-width: 18rem;">
          <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
            <div class="portfolio-item-caption-content text-center text-white">
              <b>ลาป่วย</b>
            </div>
          </div>
          <img class="img-fluid" src="img/portfolio/headact.png" alt="">
        </div>
      </div>

      <!-- Portfolio Item 2 -->
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-achor="bottom-center" >
        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal2" onclick="Datepicker2();" style="max-width: 18rem;">
          <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
            <div class="portfolio-item-caption-content text-center text-white">
              <b>ลากิจ</b>
            </div>
          </div>
          <img class="img-fluid" src="img/portfolio/personal.png" alt="">
        </div>
      </div>

      <!-- Portfolio Item 3 -->
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-achor="bottom-center">
        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal3" onclick="Datepicker3();" style="max-width: 18rem;">
          <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
            <div class="portfolio-item-caption-content text-center text-white">
              <b>ลาพักร้อน</b>
            </div>
          </div>
          <img class="img-fluid" src="img/portfolio/summer.png" alt="">
        </div>
      </div>
      <?php require('tab.php'); ?>

    </div>
    <!-- /.row -->
  </div>

</section>

<!-- About Section -->
<section class="page-section bg-primary text-white mb-0" id="about">
  <div class="container">
    <!-- About Section Heading -->
    <h2 class="page-section-heading text-center text-uppercase text-white mb-5">พนักงานบริษัท</h2>
    <!-- content -->
    <?php $sql_user_all = mysqli_query($conn, "SELECT * FROM member WHERE status = 'user'");  ?>
    <div class="owl-carousel">

      <?php while($row_user_all = mysqli_fetch_assoc($sql_user_all)) { ?>
        <div class="item">
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="../images/user/<?php echo $row_user_all['image_user']; ?>" height="100%" alt="" />
              </div>
              <div class="flip-card-back">
                <h1><?php echo $row_user_all['fistname'].'&nbsp;'.$row_user_all['lastname']; ?></h1>
                <p>ตำแหน่ง <?php echo $row_user_all['department']; ?></p>
                <p>ที่อยู่ <?php echo $row_user_all['address']; ?></p>
                <p>อีเมลล์ <?php echo $row_user_all['email']; ?></p>
                <p>เบอร์โทรศัพท์ <?php echo $row_user_all['tel']; ?></p>
              </div>
            </div>
          </div> 
        </div>
      <?php } ?>
      
    </div>
    <div class="text-center">
      <a href="staff_all.php" class="btn btn-light"><i class="fas fa-users"></i>&nbsp;พนักงานทั้งหมด</a>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section class="page-section" id="contact" data-aos="slide-right">
  <div class="container">

    <!-- Contact Section Heading -->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">ตารางวันหยุด</h2>

    <!-- Icon Divider -->
    <div class="divider-custom">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon">
        <i class="fas fa-star"></i>
      </div>
      <div class="divider-custom-line"></div>
    </div>

    <!-- Contact Section Form -->
    <div class="row">
      <div class="col-lg-15 mx-auto">
        <!-- calendar. -->
        <div id="calendar" class="col-centered"> </div>
      </div>
    </div>

  </div>
</section>

<!-- Footer -->
<footer class="footer text-center">
  <div class="container">
    <div class="row">

      <!-- Footer Location -->
      <div class="col-lg-4 mb-5 mb-lg-0">
        <h4 class="text-uppercase mb-4">ตำแหน่งที่ตั้งของบริษัท</h4>
        <p class="lead mb-0">491 12 ถนนเพชรเกษม ตำบล หาดใหญ่ อำเภอหาดใหญ่ สงขลา 90110</p>
      </div>

      <!-- Footer Social Icons -->
      <div class="col-lg-4 mb-5 mb-lg-0">
        <h4 class="text-uppercase mb-4">ติดต่อเราผ่าน</h4>
        <a class="btn btn-outline-light btn-social mx-1" href="#">
          <i class="fab fa-fw fa-facebook-f"></i>
        </a>
        <a class="btn btn-outline-light btn-social mx-1" href="#">
          <i class="fab fa-fw fa-twitter"></i>
        </a>
        <a class="btn btn-outline-light btn-social mx-1" href="#">
          <i class="fab fa-fw fa-linkedin-in"></i>
        </a>
        <a class="btn btn-outline-light btn-social mx-1" href="#">
          <i class="fab fa-fw fa-dribbble"></i>
        </a>
      </div>

      <!-- Footer About Text -->
      <div class="col-lg-4">
        <h4 class="text-uppercase mb-4">รับทำเว็บไซต์ ออกแบบเว็บไซต์ Web Design ดูแลเว็บทั้งระบบ THAIWEBEASY</h4>

      </div>

    </div>
  </div>
</footer>

<!-- Copyright Section -->
<section class="copyright py-4 text-center text-white">
  <div class="container">
    <small>Copyright &copy; Your Website 2019</small>
  </div>
</section>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-to-top d-lg-none position-fixed ">
  <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
  </a>
</div>
<?php require('modal.php'); ?>




<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/freelancer.min.js"></script>
<!-- lightbox 2 -->
<script src="dist/js/lightbox-plus-jquery.js"></script>

<!-- bootstrap 4 script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- jQuery Version 1.11.1   FullCalendar confirm-->
<script src="js/jquery.js"></script>
<script src="dist/js/jquery-confirm.min.js"></script>
<script src='js/moment.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
<script type="text/javascript" src="js/lang/th.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- dataTable -->

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Datepicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/Datepicker.js"></script>
<!-- Preview Image -->
<script src="js/PreviewImage.js"></script>
<!-- ChangeDate(EDIT) -->
<script src="js/ChangeDatepicker.js"></script>
<script src="js/readmore.js"></script>
<script src="js/dataTable.js"></script>
<!-- owl -->
<script src="js/owl.carousel.js"></script>


</body>
</html>
<script>
  $(window).load(function() { 
    setInterval(function(){ $(".loading").fadeOut('normal'); }, 500);
  });
</script>
<script>
  jQuery.noConflict();
  jQuery(document).ready(function(){
    jQuery('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      responsiveClass:true,
      responsive:{
        0:{
          items:1,
          stagePadding: 60
        },
        600:{
          items:1,
          stagePadding: 100
        },
        1000:{
          items:1,
          stagePadding: 200
        },
        1200:{
          items:1,
          stagePadding: 250
        },
        1400:{
          items:1,
          stagePadding: 300
        },
        1600:{
          items:1,
          stagePadding: 350
        },
        1800:{
          items:1,
          stagePadding: 400
        }
      }
    })
  });
</script>
<script>
  var $id = jQuery.noConflict();
  $id(document).ready(function() {
    $id('#EditForm_Staff').on('show.bs.modal', function (event) {
    var button = $id(event.relatedTarget) // Button that triggered the modal
    var header_form = button.data('sick')
    var ID_leave = button.data('id')
    var fistname = button.data('fistname')
    var day_num = button.data('day-num')
    var dates = button.data('dates')
    var date_range = button.data('date-range')
    var type_sick = button.data('type-sick');
    var detail_sick = button.data('detail-sick')
    var image_name = button.data('image-name')


    var format_date_to = new Date(dates);
    var d = format_date_to.getDate();
    var m =  format_date_to.getMonth();
    var y = format_date_to.getFullYear();
    var monthNames = ["01", "02", "03","04", "05", "06", "07","08", "09", "10","11", "12"];
    var mountcut = monthNames[m];
    var dates = (d + "-" + mountcut + "-" + y);

    var format_date_range = new Date(date_range);
    var d = format_date_range.getDate();
    var m = format_date_range.getMonth();  // m += 1;  // JavaScript months are 0-11
    var y = format_date_range.getFullYear();
    var monthNames = ["01", "02", "03","04", "05", "06", "07","08", "09", "10","11", "12"];
    var mountcut = monthNames[m];
    var date_range = (d + "-" + mountcut + "-" + y);

    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $id(this)
    modal.find('#header_form').html(header_form);
    modal.find('#ID_leave').val(ID_leave)
    modal.find('#fistname').val(fistname)
    modal.find('#days').val(day_num)
    $id('input[name="type_sick[]"][value="'+type_sick+'"]').prop('checked',true);
    modal.find('#from-edit').val(dates)
    modal.find('#to-edit').val(date_range)
    modal.find('#detail_sick').val(detail_sick)
    modal.find('.view-image').val(image_name);

    //view image old
    
    htmlData = '';
    if(image_name != "") {
      htmlData = '<a href="#" id="image_old" data-hotel-code="nases">(Click to View รูปภาพเก่า)</a><br><br>';
      htmlData += '<div class="imageview"></div>';
    }
    $('#EditForm_Staff').find('.view-image').html(htmlData);
    $(".imageview").hide();
    $(document).on("click", "#image_old", function(event) {
      $(".imageview").toggle();
      event.preventDefault();
      htmlData += '<div id="gallery_old_image">';

      htmlData = '<img src="../images/'+image_name+'" style="max-width:100px;" />';

      htmlData += '</div>';


      $('.imageview').html(htmlData);

    }); 

    //if display:none;
    if(type_sick != 'ลาเต็มวัน') {
      $id("#to-edit").css('display', 'none');
    }
    //refresh modal
    $id('#EditForm_Staff').on('hidden.bs.modal', function () {
     location.reload(false);
   })
  })
  });

</script>
<script>
  $('.example-p-1').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
    var delete_form = $(this).attr("data-delete")
    var image_name = $(this).attr("data-image-name")
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
              method: "POST",
              url: "delete.php",
              data: { ID_leave: delete_form, image_name:image_name },
              success: function(){
                $(document).ajaxStop(function(){
                  window.location.reload(false);
                });
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
  $(document).ready(function()  {
    $("#alert").delay(700).fadeOut("slow");
  });
</script>



<script type="text/javascript">
  $(document).on('click', '#log-out', function() {
   var formData = $(this).serialize();
   /* Act on the event */
   Swal.fire({
    title: 'ออกจากระบบ',
    text: "คุณต้องการออกจากระบบหรือมั้ย",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ต้องการออกจากระบบ',
    cancelButtonText: 'ยกเลิก',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: 'logout.php',
        type: 'POST',
        dataType: 'html',
        data:formData,
        success: function(data){ 
          console.log(data);       
          Swal.fire({
            type:  'success',
            title: 'ออกจากระบบ',
            text: 'ออกจากระบบสำเร็จ',
            confirmButtonText: 'ตกลง'
          })
          setTimeout(function(){window.location.href="../index.php"}, 1500);
        }
      })
    }
  })
});

</script>
<script type="text/javascript">
  AOS.init({
    duration : 1000,
  })
</script>



<script>

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },

      select: function(start, end) {

        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element) {
        element.bind('dblclick', function() {
          $('#ModalEdit #id').val(event.id);
          $('#ModalEdit #title').val(event.title);
          $('#ModalEdit #color').val(event.color);
          $('#ModalEdit').modal('show');
        });
      },
      eventDrop: function(event, delta, revertFunc) { // si changement de position

        edit(event);

      },
      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

        edit(event);

      },
      events: [
      <?php foreach($events as $event): 

        $start = explode(" ", $event['start']);
        $end = explode(" ", $event['end']);
        if($start[1] == '00:00:00'){
          $start = $start[0];
        }else{
          $start = $event['start'];
        }
        if($end[1] == '00:00:00'){
          $end = $end[0];
        }else{
          $end = $event['end'];
        }
        ?>
        {
          id: '<?php echo $event['id']; ?>',
          title: '<?php echo $event['title']; ?>',
          start: '<?php echo $start; ?>',
          end: '<?php echo $end; ?>',
          color: '<?php echo $event['color']; ?>',
        },
      <?php endforeach; ?>
      ]
    });

    function edit(event){
      start = event.start.format('YYYY-MM-DD HH:mm:ss');
      if(event.end){
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
      }else{
        end = start;
      }

      id =  event.id;

      Event = [];
      Event[0] = id;
      Event[1] = start;
      Event[2] = end;

      $.ajax({
       url: 'editEventDate.php',
       type: "POST",
       data: {Event:Event},
       success: function(rep) {
        if(rep == 'OK'){
          alert('Saved');
        }else{
          alert('Could not be saved. try again.'); 
        }
      }
    });
    }

  });

</script>