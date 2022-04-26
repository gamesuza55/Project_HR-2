
<!-- Portfolio Modals -->

<!-- Portfolio Modal 1 -->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius:0px; border:1px solid black;">
      <div class="modal-header">
        <h5 class="modal-title">ใบลาป่วย</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm">
              <!-- Portfolio Modal - Title -->

              <?php
              $sql    = "SELECT * FROM member WHERE username = '".$_SESSION['user']."' ";
              $result = mysqli_query($conn, $sql);  
              $row    = mysqli_fetch_assoc($result);

              $yearSick = date('Y');
              $sqlSick = mysqli_query($conn, "SELECT dates,sum(day_num) as SickDay, count(sick) as CountSickDay FROM sick_leave WHERE sick = 'ลาป่วย' AND date_format(dates, '%Y ') = '$yearSick ' AND fistname = '".$row['fistname']."' ");
              $rowSick = mysqli_fetch_assoc( $sqlSick);

              ?>
              <!--form ใบลาป่วย-->
              <form name="insert_form_sick" action="insert_form_sick.php" method="POST" enctype="multipart/form-data" id="form_sick"> 
                <div class="">
                  <div id="sick" class="leave sick">
                    <!--form Hidden fistname -->
                    <input type="hidden" name="fistname" value=<?php echo $row['fistname']; ?> >    
                    <!--form การลา -->
                    <input type="hidden" name="sicks" value="ลาป่วย" />
                    <input type="hidden" name="status" value="กำลังรอการอนุมัติ" />   
                    <!--form จำนวนวันที่ลา fullday -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-4"  id="output-full-day">
                          <label>จำนวนวันที่ลา&nbsp;<span style="color:red;">*</span>

                            <input type="text"  name="counts" id="days-sick" value="1" readonly style="color:red;border:none;width:100px;background-color:transparent;text-align:center;">

                            &nbsp;วัน
                          </label>  
                        </div>
                      </div>
                      <div style="position: absolute;right: 0;top:0;">
                        <b class="text-white float-right bg-danger">จำนวนลาพักร้อนสูงสุด 3 วัน</b><br/>
                        <?php if($rowSick['SickDay'] > 3) {?>
                          <p class="text-danger float-right " style="margin-bottom: 0px;">จำนวนที่ลา<b>เกินกำหนดแล้ว <?php echo $rowSick['CountSickDay']?> ครั้ง&nbsp;|&nbsp;จำนวน <?php echo $rowSick['SickDay']?> วัน/ปี</b></p>
                          <div class="text-warning text-right">รอพิจารณาการทำงาน</div>
                        <?php } elseif($rowSick['SickDay'] == 0) { ?>
                          <p class="float-right">จำนวนที่ลาไปแล้ว <b><?php echo $rowSick['CountSickDay']?> ครั้ง&nbsp;|&nbsp;จำนวน 0 วัน/ปี</b></p>
                        <?php } else { ?>
                          <p class="float-right">จำนวนที่ลาไปแล้ว <b><?php echo $rowSick['CountSickDay']?> ครั้ง&nbsp;|&nbsp;จำนวน <?php echo $rowSick['SickDay']?> วัน/ปี</b></p>
                        <?php }?>
                      </div>
                    </div>
                    <!--form type-->
                    <div class="mb-3" >
                      <label class="">ประเภทการลา&nbsp;<span style="color:red;">*</span></label><br/>
                      <label class="radio-inline mr-2">
                        <input type="radio" name="type_sick[]" value="ลาเต็มวัน" checked onclick="countDay1('1.0')" />&nbsp;ลาเต็มวัน 
                      </label>
                      <label class="radio-inline mr-2">
                        <input type="radio" name="type_sick[]" id="MN" value="ลาครึ่งวัน-เช้า" onclick="countDay1('0.5MN')"/>&nbsp;ลาครึ่งวันเช้า
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="type_sick[]" id="AF" value="ลาครึ่งวัน-บ่าย" onclick="countDay1('0.5AF')"/>&nbsp;ลาครึ่งวันบ่าย
                      </label>
                    </div>
                    <!--form date-->
                    <div class="form-inline mt-2 mb-2">
                      <label for="End">วันที่ลา&nbsp;</label>
                      <div class="form-group mr-5">
                        <div class="input-group date">
                          <input class="form-control datepicker" type="text" name="start_sick" id="from-sick" value="<?php echo DateThaiModal(date('Y-m-d')); ?>" disabled />
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                      </div>
                      <label for="End" >ถึงวันที่&nbsp;</label>
                      <div class="form-group">
                        <div class="input-group date">
                          <input class="form-control datepicker" type="text" name="end_sick" id="to-sick" value="<?php echo DateThaiModal(date('Y-m-d')); ?>"  />
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                      </div>
                    </div>  
                    <!--form detail-->
                    <div class="form-group">
                      <label for="comment">ลาป่วยเนื่องจาก&nbsp;<span style="color:red;">*</span> </label>
                      <textarea class="form-control" rows="5" id="detail_sick" name="detail_sick"  /></textarea>
                    </div>
                    <!--form upload-->
                    <div class="custom-file mb-4 w-25 ">
                      <input  type="file" class="custom-file-input" name="fileToUpload" id="files1" accept="image/png, image/gif, image/jpeg" />
                      <label class="custom-file-label try1" for="customFile">Choose file</label>
                      <br/> <span style="color:red;">**ขนาดไม่เกิน 500KB</span>

                    </div><br/>
                    <!--submit-->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" style="border-radius:initial";>ตกลง</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:initial;">ปิด</button>

                    </div>
                  </div>
                </div>      
              </form>
              <!-- /form ใบลาป่วย -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Portfolio Modal 2 -->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius:0px; border:1px solid black;">
      <div class="modal-header">
        <h5 class="modal-title">ใบลากิจ</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm">
              <!-- Portfolio Modal - Title -->

              <?php
              $yearPersonal = date('Y');
              $sqlPersonal = mysqli_query($conn, "SELECT dates,sum(day_num) as PersonalDay, count(sick) as CountPersonalDay FROM sick_leave WHERE sick = 'ลากิจ' AND date_format(dates, '%Y ') = '$yearPersonal ' AND fistname = '".$row['fistname']."' ");
              $rowPersonal = mysqli_fetch_assoc( $sqlPersonal);
              ?>
              <!--form ใบลากิจ -->
              <form name="insert_form_sick" action="insert_form_sick.php" method="POST" enctype="multipart/form-data" id="form_personal"> 
                <div class="">
                  <div id="sick" class="leave sick">
                    <!--form Hidden fistname -->
                    <input type="hidden" name="fistname" value=<?php echo $row['fistname']; ?> >    
                    <!--form การลา -->
                    <input type="hidden" name="sicks" value="ลากิจ" />
                    <input type="hidden" name="status" value="กำลังรอการอนุมัติ" />   
                    <!--form จำนวนวันที่ลา fullday -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-4"  id="output-full-day">
                          <label>จำนวนวันที่ลา&nbsp;<span style="color:red;">*</span>

                            <input type="text"  name="counts" id="days-personal" value="1" readonly style="color:red;border:none;width:100px;background-color:transparent;text-align:center;">

                            &nbsp;วัน
                          </label>  
                        </div>
                      </div>
                      <div style="position: absolute;right: 0;top:0;">
                        <b class="text-white float-right bg-danger">จำนวนลาพักร้อนสูงสุด 3 วัน</b><br/>
                        <?php if($rowPersonal['PersonalDay'] > 3) {?>
                          <p class="text-danger float-right " style="margin-bottom: 0px;">จำนวนที่ลา<b>เกินกำหนดแล้ว <?php echo $rowPersonal['CountPersonalDay']?> ครั้ง&nbsp;|&nbsp;จำนวน <?php echo $rowPersonal['PersonalDay']?> วัน/ปี</b></p>
                          <div class="text-warning text-right">รอพิจารณาการทำงาน</div>
                        <?php } elseif($rowPersonal['PersonalDay'] == 0) { ?>
                          <p class="float-right">จำนวนที่ลาไปแล้ว <b><?php echo $rowPersonal['CountPersonalDay']?> ครั้ง&nbsp;|&nbsp;จำนวน 0 วัน/ปี</b></p>
                        <?php } else { ?>
                          <p class="float-right">จำนวนที่ลาไปแล้ว <b><?php echo $rowPersonal['CountPersonalDay']?> ครั้ง&nbsp;|&nbsp;จำนวน <?php echo $rowPersonal['PersonalDay']?> วัน/ปี</b></p>
                        <?php }?>
                      </div>
                    </div>
                    <!--form type-->
                    <div class="mb-3" >
                      <label class="">ประเภทการลา&nbsp;<span style="color:red;">*</span></label><br/>
                      <label class="radio-inline mr-2">
                        <input type="radio" name="type_sick[]" value="ลาเต็มวัน" checked onclick="countDay2('1.0')" />&nbsp;ลาเต็มวัน 
                      </label>
                      <label class="radio-inline mr-2">
                        <input type="radio" name="type_sick[]" id="MN" value="ลาครึ่งวัน-เช้า" onclick="countDay2('0.5MN')"/>&nbsp;ลาครึ่งวันเช้า
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="type_sick[]" id="AF" value="ลาครึ่งวัน-บ่าย" onclick="countDay2('0.5AF')"/>&nbsp;ลาครึ่งวันบ่าย
                      </label>
                    </div>
                    <!--form date-->
                    <div class="form-inline mt-2 mb-2">
                      <label for="End">วันที่ลา&nbsp;</label>
                      <div class="form-group mr-5">
                        <div class="input-group date">
                          <input class="form-control datepicker" type="text" name="start_sick" id="from-personal" value="<?php echo DateThaiModal(date('Y-m-d')); ?>" disabled/>
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                      </div>
                      <label for="End" >ถึงวันที่&nbsp;</label>
                      <div class="form-group">
                        <div class="input-group date">
                          <input class="form-control datepicker" type="text" name="end_sick" id="to-personal" value="<?php echo DateThaiModal(date('Y-m-d')); ?>"  />
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                      </div>
                    </div>  
                    <!--form detail-->
                    <div class="form-group">
                      <label for="comment">ลาป่วยเนื่องจาก&nbsp;<span style="color:red;">*</span> </label>
                      <textarea class="form-control" rows="5" id="detail_sick" name="detail_sick"  /></textarea>
                    </div>
                    <!--form upload-->
                    <div class="custom-file mb-4 w-25 ">
                      <input  type="file" class="custom-file-input files" name="fileToUpload" id="files2" accept="image/png, image/gif, image/jpeg"/>
                      <label class="custom-file-label try2" for="customFile">Choose file</label>
                      <br/> <span style="color:red;">**ขนาดไม่เกิน 500KB</span>

                    </div><br/>
                    <!--submit-->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" style="border-radius:initial";>ตกลง</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:initial;">ปิด</button>

                    </div>
                  </div>
                </div>      
              </form>
              <!-- /form ใบลากิจ -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Portfolio Modal 3 -->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius:0px; border:1px solid black;">
      <div class="modal-header">
        <h5 class="modal-title">ใบลาพักร้อน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm">
              <!-- Portfolio Modal - Title -->

              <?php

              $yearSummer = date('Y');
              $sqlSummer = mysqli_query($conn, "SELECT dates,sum(day_num) as SummerDay, count(sick) as CountSummerDay FROM sick_leave WHERE sick = 'ลาพักร้อน' AND date_format(dates, '%Y ') = '$yearSummer' AND fistname = '".$row['fistname']."' ");
              $rowSummer = mysqli_fetch_assoc($sqlSummer);
              ?>
              <!--form ใบลาพักร้อน-->
              <form name="insert_form_sick" action="insert_form_sick.php" method="POST" id="form_summer"> 
                <div class="">
                  <div id="sick" class="leave sick">
                    <!--form Hidden fistname -->
                    <input type="hidden" name="fistname" value=<?php echo $row['fistname']; ?> >    
                    <!--form การลา -->
                    <input type="hidden" name="sicks" value="ลาพักร้อน" />
                    <input type="hidden" name="status" value="กำลังรอการอนุมัติ" />   
                    <!--form จำนวนวันที่ลา fullday -->

                    <div class="mb-4"  id="output-full-day">
                      <label>จำนวนวันที่ลา&nbsp;<span style="color:red;">*</span>

                        <input type="text"  name="counts" id="days-summer" value="1" readonly style="color:red;border:none;width:100px;background-color:transparent;text-align:center;">

                        &nbsp;วัน
                      </label>  

                      <div style="position: absolute;right: 0;top:0;">
                        <b class="text-white float-right bg-danger">จำนวนลาพักร้อนสูงสุด 3 วัน</b><br/>
                        <?php if($rowSummer['SummerDay'] > 3) {?>
                          <p class="text-danger float-right ">จำนวนที่ลา<b>เกินกำหนดแล้ว <?php echo $rowSummer['CountSummerDay']?> ครั้ง&nbsp;|&nbsp;จำนวน <?php echo $rowSummer['SummerDay']?> วัน/ปี</b></p>
                        <?php } elseif($rowSummer['SummerDay'] == 0) { ?>
                          <p class="float-right">จำนวนที่ลาไปแล้ว <b><?php echo $rowSummer['CountSummerDay']?> ครั้ง&nbsp;|&nbsp;จำนวน 0 วัน/ปี</b></p>
                        <?php } else { ?>
                          <p class="float-right">จำนวนที่ลาไปแล้ว <b><?php echo $rowSummer['CountSummerDay']?> ครั้ง&nbsp;|&nbsp;จำนวน <?php echo $rowSummer['SummerDay']?> วัน/ปี</b></p>
                        <?php }?>
                      </div>


                    </div>
                    <!--form type-->
                    <div class="mb-3" >
                      <label class="">ประเภทการลา&nbsp;<span style="color:red;">*</span></label><br/>
                      <label class="radio-inline mr-2">
                        <input type="radio" name="type_sick[]" value="ลาเต็มวัน" checked onclick="countDay3('1.0')" />&nbsp;ลาเต็มวัน 
                      </label>
                      <label class="radio-inline mr-2">
                        <input type="radio" name="type_sick[]" id="MN" value="ลาครึ่งวัน-เช้า" onclick="countDay3('0.5MN')"/>&nbsp;ลาครึ่งวันเช้า
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="type_sick[]" id="AF" value="ลาครึ่งวัน-บ่าย" onclick="countDay3('0.5AF')"/>&nbsp;ลาครึ่งวันบ่าย
                      </label>
                    </div>
                    <!--form date-->
                    <div class="form-inline mt-2 mb-2">
                      <label for="End">วันที่ลา&nbsp;</label>
                      <div class="form-group mr-5">
                        <div class="input-group date">
                          <input class="form-control datepicker" type="text" name="start_sick" id="from-summer" value="<?php echo DateThaiModal(date('Y-m-d')); ?>" disabled/>
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                      </div>
                      <label for="End" >ถึงวันที่&nbsp;</label>
                      <div class="form-group">
                        <div class="input-group date">
                          <input class="form-control datepicker" type="text" name="end_sick" id="to-summer" value="<?php echo DateThaiModal(date('Y-m-d')); ?>"  />
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                      </div>
                    </div>  
                    <!--form detail-->
                    <div class="form-group">
                      <label for="comment">ลาป่วยเนื่องจาก&nbsp;<span style="color:red;">*</span> </label>
                      <textarea class="form-control" rows="5" id="detail_sick" name="detail_sick"  /></textarea>
                    </div>
                    <!--form upload-->
                     <!--  <div class="custom-file mb-4 w-25 ">
                        <input  type="file" class="custom-file-input files" name="fileToUpload" id="files2" accept="image/png, image/gif, image/jpeg"/>
                        <label class="custom-file-label try2" for="customFile">Choose file</label>
                        <br/> <span style="color:red;">**ขนาดไม่เกิน 500KB</span>

                      </div> --><br/>
                      <!--submit-->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="border-radius:initial";>ตกลง</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:initial;">ปิด</button>

                      </div>
                    </div>
                  </div>      
                </form>
                <!-- /form ใบลาพักร้อน -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <!-- Portfolio Modal - EDIT -->
  <div class="portfolio-modal modal fade" id="EditForm_Staff" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius:0px; border:1px solid black;">
        <div class="modal-header">
          <h5 class="modal-title" id="header_form"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-sm">
                <!-- Portfolio Modal - Title -->
                <?php echo isset($_POST['header_form']); ?>
                <!--form edit-->
                <form name="update_form_sick" action="update_form_sick.php" method="POST" enctype="multipart/form-data" id="edit_sick"> 
                  <div class="">
                    <div id="sick" class="leave sick">
                      <!--form Hidden fistname -->
                      <input type="hidden" name="ID_leave" id="ID_leave">
                      <input type="hidden" name="fistname" id="fistname">    
                      <!--form การลา -->
                      <input type="hidden" name="sicks" value="ลาป่วย" />
                      <input type="hidden" name="status" value="กำลังรอการอนุมัติ" />   
                      <!--form จำนวนวันที่ลา fullday -->
                      <div class="mb-4"  id="output-full-day">
                        <label>จำนวนวันที่ลา&nbsp;<span style="color:red;">*</span>

                          <input type="text"  name="counts" id="days" value="1" readonly style="color:red;border:none;width:100px;background-color:transparent;text-align:center;">

                          &nbsp;วัน
                        </label>  
                      </div>
                      <!--form type-->
                      <div class="mb-3" >
                        <label class="">ประเภทการลา&nbsp;<span style="color:red;">*</span></label><br/>
                        <label class="radio-inline mr-2">
                          <input type="radio" name="type_sick[]" value="ลาเต็มวัน" checked onclick="countDayEdit('1.0')" />&nbsp;ลาเต็มวัน 
                        </label>
                        <label class="radio-inline mr-2">
                          <input type="radio" name="type_sick[]" id="MN" value="ลาครึ่งวัน-เช้า" onclick="countDayEdit('0.5MN')"/>&nbsp;ลาครึ่งวันเช้า
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="type_sick[]" id="AF" value="ลาครึ่งวัน-บ่าย" onclick="countDayEdit('0.5AF')"/>&nbsp;ลาครึ่งวันบ่าย
                        </label>
                      </div>
                      <!--form date-->
                      <div class="form-inline mt-2 mb-2">
                        <label for="End">วันที่ลา&nbsp;</label>
                        <div class="form-group mr-5">
                          <div class="input-group date">
                            <input class="form-control datepicker" type="text" name="start_sick" id="from-edit" readonly/>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                          </div>
                        </div>
                        <label for="End" >ถึงวันที่&nbsp;</label>
                        <div class="form-group">
                          <div class="input-group date">
                            <input class="form-control datepicker" type="text" name="end_sick" id="to-edit"/>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                          </div>
                        </div>
                      </div>  
                      <!--form detail-->
                      <div class="form-group">
                        <label for="comment">ลาป่วยเนื่องจาก&nbsp;<span style="color:red;">*</span> </label>
                        <textarea class="form-control" rows="5" id="detail_sick" name="detail_sick"  /></textarea>
                      </div>

                      <!--form upload-->
                      <div class="custom-file mb-4 w-25 ">
                        <input  type="file" class="custom-file-input" name="fileToUpload" id="files-edit" accept="image/png, image/gif, image/jpeg"/>
                        <label class="custom-file-label try-edit" for="customFile">Choose file</label>
                        <input type="hidden" name="image_upload" class="view-image" />
                        <div class="view-image"></div>
                        <br/> <span style="color:red;">**ขนาดไม่เกิน 500KB</span>

                      </div><br/>

                      <!--submit-->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary save" style="border-radius:initial;">ตกลง</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:initial;">ปิด</button>

                      </div>
                    </div>
                  </div>      
                </form>
                <!-- /form ใบลาป่วย -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php
  function DateThaiModal($strDate)
  {
    $strYear = date("Y",strtotime($strDate));
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $strMonthCut = Array("","01", "02", "03",
      "04", "05", "06", "07",
      "08", "09", "10",
      "11", "12");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay-$strMonthThai-$strYear" ;/*, $strHour:$strMinute";*/
  }

  ?>
