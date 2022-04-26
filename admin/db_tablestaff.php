
<div class="table-responsive some-list-staff">
  <table class="table table-striped table-hover">
    <thead>
      <tr class="table-active">
        <th class="text-center">ชื่อ</th>
        <th class="text-center">การลา</th>
        <th class="text-center">วันที่ลา</th>
        <th class="text-center">จำนวนวัน</th>
        <th class="text-center">สถานะ</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = mysqli_query($conn, "SELECT * FROM sick_leave ORDER BY ID_leave DESC ");
      if(mysqli_num_rows($sql) > 0) {
        while($row = mysqli_fetch_assoc($sql)) { 
          ?>
          <tr align="center">
            <td><?php echo $row['fistname'];?></td>
            <td>
              <?php echo $row['sick']; ?><br/>
              <p class="text-muted"><?php echo $row['type_sick']; ?></p>
            </td>
            <td> <?php echo DateThai($row['dates']); ?> <b>ถึง</b> <?php echo DateThai($row['date_range']); ?></td>
            <td><?php echo $row['day_num']; ?></td>
            <td>
              <?php if($row['status'] == "อนุมัติ") {?>
                <span class="label label-success"><?php echo $row['status']; ?></span>
              <?php } elseif($row['status']== "กำลังรอการอนุมัติ") { ?>
                <span class="label label-warning"><?php echo $row['status']; ?></span>
              <?php } elseif($row['status']== "ไม่อนุมัติ") { ?>
                <span class="label label-danger"><?php echo $row['status']; ?></span>
              <?php }?>
            </td>
          </tr>
        <?php }
      } else {
         echo '<td colspan="5" class="text-center">ไม่มีข้อมูล</td>';
      } 
      ?>
    </tbody>
  </table>
</div>