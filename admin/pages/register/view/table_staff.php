  
<?php

function DateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
  $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear" ;/*, $strHour:$strMinute";*/
}

?>

<?php
$sql = mysqli_query($conn, "SELECT * FROM member where status = 'user' ");



?>
<div class="table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>username</th>
        <th>ชื่อพนักงาน</th>
        <th>ข้อมูลส่วนตัว</th>
        <th>แผนก</th>
        <th>ที่อยู่</th>
        <th>สถานะพนักงาน</th>
        <th>จัดการ</th>

      </tr>
    </thead>
    <tbody>
      <?php 
      while($row = mysqli_fetch_assoc($sql)) { 
        $src = "";

        if(@$row['image_name'] != "") {
          $src = "../../../images/{$row['image_name']}";
        }
        ?>

        <tr align="left">

          <td> 
            <div class="row">
              <div class="col-md-6 text-right">
                <?php echo $row['username'].'<br/>';?>
              </div>
              <div class="col-md-6 mr-3 ">
               <img src="../../../images/user/<?php echo $row['image_user']?>" alt="profile" height="50px" style="max-width:50px; max-height:50px;"> 
             </div>
           </div>
         </td>
         <td> 
          <?php echo $row['fistname'].'&nbsp'.$row['lastname']?>
          <?php echo '<div class="text-muted">ชื่อเล่น&nbsp;'.$row['nickname'].'</div>'; ?> 
          <div class="text-muted">เพศ:&nbsp; <?php  if($row['gendar'] == 'male') { echo 'ผู้ชาย';} elseif($row['gendar'] == 'female') { echo 'ผู้หญิง';}  ?></div>
        </td>
        <td> <?php echo $row['email'].'<div class="text-muted">วันเกิด:&nbsp;'.DateThai($row['birthday']).'</br>เบอร์:&nbsp;'.$row['tel'].'</div>'; ?> </td>
        <td width="19%"> 
          <?php echo $row['department']; ?>
          <div class=text-muted>เริ่มทำงาน&nbsp;<?php echo DateThai($row['start_work']);  ?></div>
          <?php if($row['status_user'] == "1"){ ?>
            <div class="text-muted">สิ้นสุดทำงาน&nbsp;<?php echo DateThai(date('d-m-Y'));?></div>
          <?php } ?>

        </td>
        <td width="150"> <?php echo $row['address']; ?> </td>

        <td align="center">
          <?php if($row['status_user'] == "0") {?>
            <span class="badge bg-blue">ใช้งานได้</span><br/>
            <a href="?id_user=<?php echo $row['username']?>" onclick="return confirm('ยืนยันการลาออกหรือไม่?')" class="btn btn-link">สำหรับพนักงานที่ลาออก</a>
          <?php } elseif($row['status_user'] == "1") { ?>
            <span class="badge bg-red">ออกจากงานแล้ว</span><br/>
            <a href="?id_out=<?php echo $row['username']?>" class="btn btn-link text-red">ยกเลิกพนักงานที่ลาออก</a>
          <?php } ?>
        </td>
        <td align="center" style="font-size:20px;">
         <a href="index.php?user=<?php echo isset($row['username']) ? $row['username'] : "";?>" class="text-yellow"><i class="fa fa-fw fa-edit"></i></a>&nbsp;
         <a class="text-danger del_user" data-user="<?php echo $row['username']; ?>"><i class="fa fa-fw fa-close"></i></a>
       </td>

       <?php
       $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : ""; 
       $id_out  = isset($_GET['id_out']) ? $_GET['id_out'] : "";
       
       if($id_user == $row['username']) {
        $sql_out = mysqli_query($conn, "UPDATE member SET status_user = '1' WHERE username = '".$_GET['id_user']."' ");
        if($sql_out) {
          echo "<script>location.href='register_staff.php';</script>";
        }
      } elseif($id_out == $row['username']) {
        $sql_out = mysqli_query($conn, "UPDATE member SET status_user = '0' WHERE username = '".$_GET['id_out']."' ");
        if($sql_out) {
         echo "<script>location.href='register_staff.php';</script>";
        }
      }
      ?>

<!--           <td>
            <a href="<?php echo $src; ?>" data-lightbox="example-1">
              <img src="<?php echo $src; ?>" style="max-width:100%; height:50px;">
            </a>
          </td> -->


        </tr>  
        <?php 
      }

      ?>                
    </tbody>
  </table>  
