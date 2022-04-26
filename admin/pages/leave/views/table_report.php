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
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="search_date">
  <select name="search_year" id="search_year" class="form-control mb-3 ml-3 float-right" style="width:15%" onchange="search_date.submit();">
  <option value="กรุณาเลือกข้อมูล" disabled selected>กรุณาเลือกข้อมูล</option>
    <?php
    $currently_selected = date('Y');
    $earliest_year = 2010; 
    $latest_year = date('Y'); 
    foreach ( range( $latest_year, $earliest_year ) as $i ) {
      $date_thai  = $i + 543;
      ?>
       '<option value="<?php echo $i; ?>" <?php if(@$_POST['search_year'] == $i) { echo "selected";} ?>><?php echo $date_thai; ?></option>';
      // 
      <?php
    } 

    ?>
  </select>
</form>
<div class="table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th class="text-center">ชื่อพนักงาน</th>
        <th class="text-center">ลาป่วย</th>
        <th class="text-center">ลากิจ</th>
        <th class="text-center">ลาพักร้อน</th>
        <th class="text-center">รวม</th>
        <th class="text-center">สถานะ</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $sql = mysqli_query($conn, "SELECT * FROM member WHERE status = 'user'");
      while($row = mysqli_fetch_assoc($sql)) {
        if(@$_POST['search_year']) {
          $search_year = @$_POST['search_year'];
          $sqlsickDay = mysqli_query($conn, "SELECT dates,count(sick) as SickDay FROM sick_leave WHERE sick = 'ลาป่วย' AND date_format(dates, '%Y')='$search_year' AND fistname = '".$row['fistname']."' ");
        } else {
          $sqlsickDay = mysqli_query($conn, "SELECT dates,count(sick) as SickDay FROM sick_leave WHERE sick = 'ลาป่วย' AND fistname = '".$row['fistname']."' ");
        }
        $rowsickDay = mysqli_fetch_assoc($sqlsickDay);

        if(@$_POST['search_year']) {
          $search_year = @$_POST['search_year'];
          $sqlPersonal = mysqli_query($conn, "SELECT dates,count(sick) as PerosonalDay FROM sick_leave WHERE sick = 'ลากิจ' AND date_format(dates, '%Y')='$search_year' AND fistname = '".$row['fistname']."' ");
        } else {
          $sqlPersonal = mysqli_query($conn, "SELECT count(sick) as PerosonalDay FROM sick_leave WHERE sick = 'ลากิจ' AND fistname = '".$row['fistname']."'  ");
        }
        $rowPersonalDay = mysqli_fetch_assoc($sqlPersonal);

        if(@$_POST['search_year']) {
          $sqlSummer = mysqli_query($conn, "SELECT dates,count(sick) as SummerDay FROM sick_leave WHERE sick = 'ลาพักร้อน' AND date_format(dates, '%Y')='$search_year' AND fistname = '".$row['fistname']."' ");
        } else {
          $sqlSummer = mysqli_query($conn, "SELECT count(sick) as SummerDay FROM sick_leave WHERE sick = 'ลาพักร้อน' AND fistname = '".$row['fistname']."' ");
        }
        $rowSummer = mysqli_fetch_assoc($sqlSummer);

        $totalDay = $rowsickDay['SickDay'] + $rowPersonalDay['PerosonalDay'] + $rowSummer['SummerDay']; 
        $src = "";

        if(@$row['image_name'] != "") {
          $src = "../../../images/{$row['image_name']}";
        }
        ?>

        <tr align="center">        

          <td width="150"> 
            <?php echo $row['fistname'].'&nbsp;'.$row['lastname'] ?>
            <div class="text-muted">(<?php echo $row['nickname']; ?>)</div>
          </td>
          <td> <?php echo $rowsickDay['SickDay']; ?>&nbsp;ครั้ง </td>
          <td> <?php echo $rowPersonalDay['PerosonalDay']; ?>&nbsp;ครั้ง </td>
          <td> <?php echo $rowSummer['SummerDay']; ?>&nbsp;ครั้ง </td>
          <?php if($totalDay > 3) {?>
            <td> <?php echo $totalDay?>&nbsp;ครั้ง</td>
            <td width="15%">
              <span class="text-yellow">รอพิจารณาการทำงานต่อ</span>
            </td>
          <?php } else { ?>
            <td> <?php echo $totalDay?>&nbsp;ครั้ง</td>
            <td><span class="text-green">ปกติ</span></td>
          <?php }?>

        </tr>  
        <?php 
      }
      ?> 
    </tbody>
  </table> 
</div> 
