<?php
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

<?php
$sql = mysqli_query($conn, "SELECT * FROM sick_leave WHERE status = 'กำลังรอการอนุมัติ'  ");
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th><input name="checkAll" type="checkbox" id="CheckAll" class="checkAll"></th>
          <th>ชื่อพนักงาน</th>
          <th>การลา</th>
          <th>ประเภทการลา</th>
          <th>รายระเอียด</th>
          <th>วันที่ลา</th>
          <th>จำนวนวัน</th>
          <th>ไฟล์แนบ</th>
          <th>สถานะ</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        while($row = mysqli_fetch_assoc($sql)) { 
          $src = "";

          if($row['image_name'] != "") {
            $src = "../../../images/{$row['image_name']}";
          }
          ?>

          <tr align="center">        
            <td><input name="checkItem[]"  type="checkbox" id="checkItem" class="checkItem" value="<?php echo $row['ID_leave']; ?>">
              <input name="ID_leave"  type="hidden" value="<?php echo $row['ID_leave']; ?>">
            </td>       
            <td> <?php echo $row['fistname']; ?> </td>
            <td> <?php echo $row['sick']; ?> </td>
            <td> <?php echo $row['type_sick']; ?> </td>
            <td align="left"> <?php echo $row['detail_sick']; ?> </td>
            <td> <?php echo DateThai($row['dates']); ?> </td>
            <td> <?php echo $row['day_num']; ?> </td>

            <td>
              <a href="<?php echo $src; ?>" data-lightbox="example-1">
                <img src="<?php echo $src; ?>" style="max-width:100%; height:50px;">
              </a>
            </td>
            <td> <span class="text-yellow"><?php echo $row['status']; ?></span> </td>
          </tr>  
          <?php 
        }
        ?>               
      </tbody>
      <tfoot>
        <td colspan="9">
          <div class="col-md-12 text-right">
            <button type="submit" name="submit_accept" class="btn btn-success btn-xl" style="width:10%;">อนุมัติ</button>
            <button type="submit" name="submit_no_accept" class="btn btn-danger btn-xl" style="width:10%;">ไม่อนุมัติ</button>
          </div>
        </td>
      </tfoot>
    </table> 
  </div> 
</form>

<?php 
if(isset($_POST['submit_accept'])){
  if(isset($_POST['checkItem'])) {

    for ($i=0; $i <count($_POST['checkItem']) ; $i++) { 
      $ID_leave = $_POST['checkItem'][$i];
      $sql = mysqli_query($conn, "UPDATE sick_leave SET status = 'อนุมัติ'  WHERE ID_leave = '$ID_leave'");
      echo"<META HTTP-EQUIV='Refresh' CONTENT = '0;URL=leave_staff.php'>";
    }

  } else {
    echo '<script>alert("เลือกรายการอนุมัติด้วยครับ")</script>';
  }
}
if(isset($_POST['submit_no_accept'])){
  if($_POST['checkItem']) {

    for ($i=0; $i <count($_POST['checkItem']) ; $i++) { 
      $ID_leave = $_POST['checkItem'][$i];
      $sql = mysqli_query($conn, "UPDATE sick_leave SET status = 'ไม่อนุมัติ' WHERE ID_leave = '$ID_leave'");
      echo"<META HTTP-EQUIV='Refresh' CONTENT = '0;URL=leave_staff.php'>";
    }

  } else {
    echo '<script>alert("เลือกรายการอนุมัติด้วยครับ")</script>';
  }
}




?> 