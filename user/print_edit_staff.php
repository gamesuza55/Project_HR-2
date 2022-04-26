  <?php 
  session_start();
  date_default_timezone_set("Asia/Bangkok"); 

  require_once('conn_main.php');
  $sql = mysqli_query($conn, "SELECT * FROM member WHERE username = '".$_SESSION['user']."' ");
  $row = mysqli_fetch_assoc($sql);

  $id = mysqli_query($conn, "SELECT ID_leave, CONCAT( 'TWE-', LPAD(ID_leave,5,'0')) AS id FROM sick_leave WHERE ID_leave = '".$_GET['ID']."' ");
  $row_id = mysqli_fetch_assoc($id);

  $sql_leave = mysqli_query($conn, "SELECT * FROM sick_leave WHERE ID_leave = '".$_GET['ID']."' ");
  $row_leave = mysqli_fetch_assoc($sql_leave);

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
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thaiwebeasy | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="css/icofont.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit:300&display=swap&subset=thai" rel="stylesheet"> 

    <style type="text/css">
      body {
        font-family: 'Kanit','500', sans-serif;
      }
      @media print {
        #printPageButton {
          display: none;
        }
        #back{
          display:none;
        }
      }

    </style>
  </head>
  <body onload="window.print();" >
    <a href="index.php" class="text-primary h1 p-2 " id="back" style="position: absolute; z-index: 9999;margin-left: 30px;"><i class="icofont-arrow-right icofont-rotate-180"></i></a>  
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> <img src="img/brand/logo-twe.png" height="90">
              <small class="pull-right"><?php echo date('d/m/Y H:i:s'); ?></small>
            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            จาก
            <address>
              <strong><?php echo $row['fistname'].'&nbsp;'.$row['lastname'];?>.</strong><br>
              <?php echo $row['address']?><br>
              โทรศัพท์: <?php echo $row['tel']?><br>
              อีเมลล์:  <?php echo $row['email']?>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            ถึง
            <address>
              <strong>ผู้จัดการ</strong><br>
              491/12 ซ.14 ถ.เพชรเกษม อ.หาดใหญ่ จ.สงขลา 90110<br>
              โทรศัพท์: (074) 805 444<br>
              อีเมลล์: thaiwebeasy@gmail.com
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>เลขที่ใบลา #<?php echo $row_id['id'];?></b><br>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ชื่อ</th>
                  <th>การลา</th>
                  <th>ประเภท</th>
                  <th>รายระเอียด</th>
                  <th>วันที่ลา</th>
                  <th>จำนวน</th>
                  <th>สถานะ</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $row_leave['fistname']; ?></td>
                  <td><?php echo $row_leave['sick']; ?></td>
                  <td><?php echo $row_leave['type_sick']; ?></td>
                  <td><?php echo $row_leave['detail_sick']; ?></td>
                  <td><?php echo DateThai($row_leave['dates']); ?></td>
                  <td><?php echo $row_leave['day_num']; ?></td>
                  <td><?php echo $row_leave['status']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <br/>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-6 text-center">
            <button id="printPageButton" class="btn btn-primary center" onClick="window.print();">ปริ้น</button>
          </div>
          <!-- /.col -->
          <div class="col-xs-6">
            <p class="lead text-center">ขอแสดงความนับถือ</p>
            <p class="text-center">(ลงชื่อ)............................................................................................</p>
            <p class="text-center">ตำแหน่ง ผู้จัดการ</p>
            <br/><br/><br/>

            <p class="text-center">(ลงชื่อคนลา)............................................................................................</p>
            <p class="text-center">ตำแหน่ง <?php echo $row['department']; ?></p>

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- ./wrapper -->
  </body>
  </html>

