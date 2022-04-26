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
$sql = mysqli_query($conn, "SELECT * FROM sick_leave ");



?>
<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>ชื่อพนักงาน</th>
                      <th>การลา</th>
                      <th>ประเภทการลา</th>
                      <th>รายระเอียด</th>
                      <th>วันืี่ลา</th>
                      <th>จำนวนวัน</th>
                      <th>ไฟล์แนบ</th>
                      <th>สถานะ</th>
                      <th>จัดการ</th>
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

                        <td> <?php echo $row['ID_leave']; ?> </td>
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

                      </tr>  
              <?php } ?>                
                    </tbody>
</table>  
