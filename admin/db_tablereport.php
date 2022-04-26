
<center>
  <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</center>
<div class="some-list-report ShowData" style="display:none;">
  <ul class="products-list product-list-in-box ShowData" style="display:none;">

    <?php 
    $sql_m = mysqli_query($conn, "SELECT fistname,image_user FROM member WHERE status = 'user'");
    if(mysqli_num_rows($sql_m) > 0) {
      while($row_m = mysqli_fetch_assoc($sql_m)) {

        require('fn_tablereport.php');
        $result = mysqli_query($conn, $sql_re);

        while($row_re = mysqli_fetch_assoc($result)) {
          ?>

          <li class="item some-list-4" >
            <div class="product-img">
              <img src="../images/user/<?php echo $row_m['image_user']; ?>" class="direct-chat-img">
            </div>
            <div class="product-info">
              <b class="product-title"><?php echo $row_re['fistname']; ?></b>
              <span class="text-muted pull-right"><?php echo DateThai($row_re['dates']); ?></span>
              <span class="product-description">
                <?php if($row_re['status'] == "อนุมัติ") {?>
                  <span class="label label-success"><?php echo $row_re['status']; ?></span>
                <?php } elseif($row_re['status']== "กำลังรอการอนุมัติ") { ?>
                  <span class="label label-warning"><?php echo $row_re['status']; ?></span>
                <?php } elseif($row_re['status']== "ไม่อนุมัติ") { ?>
                  <span class="label label-danger"><?php echo $row_re['status']; ?></span>
                <?php }?>
                <?php echo $row_re['sick'] ?>
              </span>
            </div>
          </li>
          <?php 
        } 

      }
    } else {
       echo "<center>ไม่มีข้อมูล</center>";
    }




    ?>


  </ul>
</div>

