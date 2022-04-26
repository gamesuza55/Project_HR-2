 <style>

  .card {
    border:none;
    border-radius:0;
  }
  .card-header {
    background-color: #2c3e50;

  }
  .btn-link {
    font-weight: 400;
    color: white;
    text-decoration: none;
  }
  .morecontent span {
    display: none;
  }
  .morelink {
    display: block;
  }
  .btn-md, .btn-group-md > .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 50%;
  }

</style>
<?php
        // echo $_SESSION['user'];


$sql = "SELECT sick_leave.ID_leave, sick_leave.type_sick, sick_leave.sick, sick_leave.detail_sick, sick_leave.dates, sick_leave.date_range, sick_leave.day_num, sick_leave.image_name, sick_leave.status
, member.username, member.fistname, member.lastname 
FROM sick_leave   
INNER JOIN member ON sick_leave.fistname = member.fistname 
WHERE username = '".$_SESSION['user']."' ORDER BY sick_leave.ID_leave DESC  ";

$result = mysqli_query($conn, $sql);
?>
<h4>ดูประวัติการลา </h4>
<div class="border-bottom w-100 mb-2"> </div>
<div class="table-responsive text-left">
  <table class="table table-bordered table-hover mt-5 " id="history_leave">
    <thead class="thead-dark">
      <tr align="center">
        <th scope="col">ชื่อพนักงาน</th>
        <th scope="col">การลา</th>
        <th scope="col">ประเภท</th>
        <th scope="col" >รายระเอียด</th>
        <th scope="col">วันที่ลา</th>
        <th scope="col">จำนวนวัน</th>
        <th scope="col">ไฟล์แนบ</th>
        <th scope="col">สถานะ</th>
        <th scope="col">จัดการ</th>
      </tr>
    </thead>
    <tbody>

      <?php 
      while($row = mysqli_fetch_assoc($result)) { 
        $src = "";
        if($row['image_name'] != "") {
          $src = "../images/{$row['image_name']}";
        }
        ?>
        <tr align="center" >
          <td width="50"><?php echo $row['fistname']; ?></td>
          <td><?php echo $row['sick']; ?></td>
          <td><span class="badge badge-pill badge-dark" style="color:white;"><?php echo $row['type_sick']; ?></span></td>             
          <td align="left" class="more" style="word-break: break-all;"><?php echo $row['detail_sick'] ?></td>
          <td><?php echo DateThai($row['dates']); ?></td>

          <td width="50"><?php echo $row['day_num']; ?></td>
          <td><a href="<?php echo $src; ?>" data-lightbox="example-1"><img src="<?php echo $src; ?>" style="max-width:100%; height:50px;"></a></td>

          <?php if($row['status'] == "กำลังรอการอนุมัติ") {  ?>

            <td><span class="badge badge-pill badge-warning text-white"><?php echo $row['status']; ?></span></td>
            <td>
              <button class="btn btn-outline-primary btn-md" title="พิมพ์" onclick="location.href='print_edit_staff.php?ID=<?php echo $row['ID_leave']; ?>'">
                <i class="fas fa-print"></i></button>

                <button type="button" class="btn btn-outline-warning btn-md EditForm_Staff" data-toggle="modal" data-target="#EditForm_Staff" 
                data-id         ="<?php echo $row['ID_leave']; ?>"
                data-fistname   ="<?php echo $row['fistname']; ?>"
                data-sick       ="<?php echo $row['sick']; ?>"
                data-type-sick  ="<?php echo $row['type_sick']; ?>"
                data-detail-sick="<?php echo $row['detail_sick']; ?>"
                data-dates      ="<?php echo $row['dates']; ?>"
                data-date-range ="<?php echo $row['date_range']; ?>"
                data-day-num    ="<?php echo $row['day_num']; ?>"
                data-image-name ="<?php echo $row['image_name']; ?>"
                onclick="DatepickerEdit();" ><i class="far fa-edit" title="แก้ไขข้อมูล"></i></button>

                <button name="delete" class="btn btn-outline-danger btn-md example-p-1" 
                data-delete ="<?php echo $row['ID_leave']; ?>"
                data-image-name ="<?php echo $row['image_name']; ?>" title="ลบข้อมูล"><i class="far fa-trash-alt"></i></button>
              </td>
            </tr>

            <?php
          }   else if($row['status'] == "อนุมัติ") {
           ?>

           <td><span class="badge badge-pill badge-success"><?php echo $row['status']; ?></span></td>
           <td >
            <button class="btn btn-outline-primary btn-md" title="พิมพ์" onclick="location.href='print_edit_staff.php?ID=<?php echo $row['ID_leave']; ?>'">
              <i class="fas fa-print"></i>
            </button>
          </td>
        </tr>

        <?php
      }   else if($row['status'] == "ไม่อนุมัติ") {
       ?>

       <td><span class="badge badge-pill badge-danger"><?php echo $row['status']; ?></span></td>
       <td >
        <button class="btn btn-outline-primary btn-md" title="พิมพ์"  onclick="location.href='print_edit_staff.php?ID=<?php echo $row['ID_leave']; ?>'">
          <i class="fas fa-print"></i></button>
        </td>
      </tr>

      <?php
    }

            //while 
  }  
  ?>

</tbody>
</table>
</div>

  <!--<div class="card mb-3">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>-->

