<style>
  .input_h {
    border:none;
    width:100px;
    background-color:transparent;
  }
  small {
    color:gray;
  }
</style>
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
<script>
  function formatDate2(date) {
  var monthNames = [
    "01", "02", "03",
    "04", "05", "06", "07",
    "08", "09", "10",
    "11", "12"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();

  return day + '-' + monthNames[monthIndex] + '-' + year;
  var now = formatDate(new Date());
}

</script>
<?php
$sql = mysqli_query($conn, "SELECT * FROM sick_leave");

// "dom": 'rtipS',

?>

<div class="row">
  <div class="col-xs-3"> 
    <small> Search ชื่อพนักงาน</small>
    <div class="serach_name"></div>
  </div>
  <div class="col-xs-3"> 
     <small> Search สถานะ</small>
    <div class="serach_status"></div>
  </div>
  <div class="col-xs-3">
    <small> Search ย้อนหลังการลา</small>
    <select id="dateFilter" class="form-control">\
      <option value="NULL">เลือกทั้งหมด</option>
      <option value="7D">ย้อนหลัง 7 วัน</option>
      <option value="15D">ย้อนหลัง 15 วัน</option>
      <option value="1M">ย้นอหลัง 1 เดือน</option>  
    </select>
  </div>
</div><br/>
<div class="table-responsive">
<table id="example2" class="table table-bordered table-striped" cellspacing="0" width="100%"><!-- class="table table-bordered table-striped"  -->
                    <thead>
                    <tr>

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

                     
                        <td> <?php echo $row['fistname']; ?> </td>
                        <td> <?php echo $row['sick']; ?> </td>
                        <td> <?php echo $row['type_sick']; ?> </td>
                        <td align="left"> <?php echo $row['detail_sick']; ?> </td>
                        <td align="left"> 
                          <span style="display:none;"><?php echo $row['dates']; ?></span>   
                          <input type="text" class="input_h" value="<?php echo DateThai($row['dates']); ?>">    
                        </td>
                        <td> <?php echo $row['day_num']; ?> </td>
                        

                        <td>
                          <a href="<?php echo $src; ?>" data-lightbox="example-1">
                            <img src="<?php echo $src; ?>" style="max-width:100%; height:50px;">
                          </a>
                        </td>
                        <td> <?php echo $row['status']; ?> </td>

                      </tr>  
              <?php } ?>                
</table>  
