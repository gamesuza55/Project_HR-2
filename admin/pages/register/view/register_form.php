<style>
  .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 6px 5px;
    height: 34px;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: gray;
    line-height: 28px;
  }
</style>
<?php if(@!$_GET['user']) { ?>
  <form id="register_form" name="register_form" action="view/insert_register.php" method="post" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail">ผู้ใช้</label>
        <input type="text" name="username" class="form-control" id="inputEmail4" placeholder="ชื่อผู้ใช้" >
      </div>
      <div class="form-group col-md-6 ">
        <label for="inputPassword">รหัสผ่าน</label>
        <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="รหัสผ่าน" >
      </div>
      <div class="form-group col-md-12">
        <input type="file" name="fileupload" id="inputFile" required>
      </div>
    </div>

    &nbsp;<hr style="border-top:1px solid #d7d7d7!important;">

    <div class="form-row">
      <!-- fistname -->
      <div class="form-group col-md-5">
        <label for="inputFistname">ชื่อ</label>
        <input class="form-control" name="fistname" id="inputFistname" rows="3" placeholder="ชื่อจริง" required >
      </div>
      <!-- lastname -->
      <div class="form-group col-md-5">
        <label for="inputLastname">นามสกุล</label>
        <input class="form-control" name="lastname" id="inputLastname" placeholder="นามสกุล" required >
      </div>
      <!-- nickname -->
      <div class="form-group col-md-2">
        <label for="inputNickname">ชื่อเล่น </label>
        <input class="form-control" name="nickname" id="inputNickname" placeholder="ชื่อเล่น"  required>
      </div>
    </div>
    <!-- วันที่เริ่มทำงาน -->
    <div class="form-group col-md-12">
      <label>วันที่เริ่มทำงาน</label>
      <div class="input-group date">

        <input type="text" name="start_work" class="form-control pull-right datepicker"  placeholder="ปี/เดือน/วัน" readonly required>
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
      </div>
    </div>
    <!-- birthday -->
    <div class="form-group col-md-6">
      <label>วันเกิด</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" name="birthday" class="form-control pull-right datepicker"  placeholder="ปี/เดือน/วัน" readonly required>
      </div>
    </div>
    <!-- department -->
    <div class="form-group col-md-6">
      <label>แผนก</label>
      <select class="form-control select2" style="width:100%;" name="department" required>
        <option selected="selected" disabled="disabled">กรุณาเลือกแผนก</option>
        <option value="Programer">โปรแกรมเมอร์(Programer)</option>
        <option value="Graphic">กราฟฟิค(Graphic Design)</option>
        <option value="Marketing">ฝ่ายขาย(Marketing)</option>
        <option value="Accounting">บัญชี(Accounting)</option>
      </select>
    </div>
    <!-- email -->
    <div class="form-group col-md-12">
      <label for="inputEmail">อีเมลล์</label>
      <input type="email" name="email" class="form-control" id="inputEmail"  placeholder="อีเมลล์" >
    </div>
    <!-- address -->
    <div class="form-group col-md-12">
      <label for="inputAddress">ที่อยู่</label>
      <textarea class="form-control" name="address" id="inputAddress" rows="3" placeholder="ที่อยู่" required></textarea>
    </div>
    <!-- radio -->
    <div class="form-group col-md-12">
      <label for="">เพศ : </label><br/>
      <input type="radio" name="gendar" class="flat-red" value="male" checked > <label for="Male" > ชาย</label>
      <input type="radio" name="gendar" class="flat-red" value="female"> <label for="female"> หญิง</label>
    </div>
    <!-- phone mask -->
    <div class="form-group col-md-12">
      <label>เบอร์โทรศัพท์</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-phone"></i>
        </div>
        <input type="text" name="tel" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask placeholder="(xxx) xxx-xxxx" required>
      </div>
      <!-- /.input group -->
    </div>

    <!-- submit -->
    <div class="form-group col-md-12 text-right">
      <button type="submit" class="btn btn-primary">ตกลง</button>
    </div>  
  </form>

  <!-- edit -->

<?php } else {
  require_once('conn.php');
  $sql = mysqli_query($conn, "SELECT * FROM member WHERE username = '".$_GET['user']."'");
  $row = mysqli_fetch_assoc($sql);
  ?>
  <form id="register_edit_form" name="register_edit_form" action="view/register_edit_form.php" method="post" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail">ผู้ใช้</label>
        <input type="text" name="username" class="form-control" id="inputEmail4" placeholder="ชื่อผู้ใช้" value="<?php echo $row['username']; ?>" readonly >
      </div>
      <div class="form-group col-md-6">
        <label>password</label>
        <div class="input-group date">
          <input type="password" id="password" name="password" class="form-control pull-right" value="<?php echo $row['password']; ?>" required>
          <div class="input-group-addon">
            <i class="fa fa-eye" id="open_pass"></i>
          </div>
        </div>
      </div>
      <div class="form-group col-md-12">
        <input type="hidden" name="fileuploadOld" value="<?php echo $row['image_user'];?>">
        <input type="file" name="fileupload" id="inputFile" >
        <img src="../../../images/user/<?php echo $row['image_user']; ?>" height="50" style="max-width:50px; max-height:50px;" alt="profile">
      </div>
    </div>

    &nbsp;<hr style="border-top:1px solid #d7d7d7!important;">

    <div class="form-row">
      <!-- fistname -->
      <div class="form-group col-md-5">
        <label for="inputFistname">ชื่อ</label>
        <input class="form-control" name="fistname" id="inputFistname" rows="3" placeholder="ชื่อจริง" value="<?php echo $row['fistname']; ?>"  required >
      </div>
      <!-- lastname -->
      <div class="form-group col-md-5">
        <label for="inputLastname">นามสกุล</label>
        <input class="form-control" name="lastname" id="inputLastname" placeholder="นามสกุล" value="<?php echo $row['lastname']; ?>"  required >
      </div>
      <!-- nickname -->
      <div class="form-group col-md-2">
        <label for="inputNickname">ชื่อเล่น </label>
        <input class="form-control" name="nickname" id="inputNickname" placeholder="ชื่อเล่น" value="<?php echo $row['nickname']; ?>"   required>
      </div>
    </div>
    <!-- birthday -->
    <div class="form-group col-md-6">
      <label>วันเกิด</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" name="birthday" class="form-control pull-right" id="datepicker_edit" value="<?php echo $row['birthday']; ?>"  readonly required>
      </div>
    </div>
    <!-- department -->
    <div class="form-group col-md-6">
      <label>แผนก</label>
      <select class="form-control select2" style="width:100%;" name="department" required>
        <option selected="selected" disabled="disabled">กรุณาเลือกแผนก</option>
        <option value="Programer" <?php if($row['department']=="Programer") { echo "selected"; } ?>>โปรแกรมเมอร์(Programer)</option>
        <option value="Graphic"  <?php if($row['department']=="Graphic") { echo "selected"; } ?>>กราฟฟิค(Graphic Design)</option>
        <option value="Marketing" <?php if($row['department']=="Marketing") { echo "selected"; } ?>>ฝ่ายขาย(Marketing)</option>
        <option value="Accounting" <?php if($row['department']=="Accounting") { echo "selected"; } ?>>บัญชี(Accounting)</option>
      </select>
    </div>
    <!-- email -->
    <div class="form-group col-md-12">
      <label for="inputEmail">อีเมลล์</label>
      <input type="email" name="email" class="form-control" id="inputEmail"  placeholder="อีเมลล์" value="<?php echo $row['email']; ?>">
    </div>
    <!-- address -->
    <div class="form-group col-md-12">
      <label for="inputAddress">ที่อยู่</label>
      <textarea class="form-control" name="address" id="inputAddress" rows="3" placeholder="ที่อยู่"  required><?php echo $row['address']; ?></textarea>
    </div>
    <!-- radio -->
    <div class="form-group col-md-12">
      <label for="">เพศ : </label><br/>
      <input type="radio" name="gendar" class="flat-red" value="male" <?php if($row['gendar']=="male") { echo "checked"; } ?> > <label for="Male" > ชาย</label>
      <input type="radio" name="gendar" class="flat-red" value="female" <?php if($row['gendar']=="female") { echo "checked"; } ?>> <label for="female"> หญิง</label>
    </div>
    <!-- phone mask -->
    <div class="form-group col-md-12">
      <label>เบอร์โทรศัพท์</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-phone"></i>
        </div>
        <input type="text" name="tel" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask placeholder="(xxx) xxx-xxxx"  value="<?php echo $row['tel'];?>" required>
      </div>
      <!-- /.input group -->
    </div>

    <!-- submit -->
    <div class="form-group col-md-12 text-right">
      <button type="submit" onclick="return confirm('ต้องการแก้ไขข้อมูลหรือไม่?');" class="btn btn-primary">ตกลง</button>
    </div>  
    <?php  ?>
  <?php } ?>

