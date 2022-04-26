 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo PATH;?>/dist/img/avatar.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> ออนไลน์</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" id="sidebar-menu" data-widget="tree">
      <li class="header">รายงาน</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="<?php if($page == 'dashboard') { echo "active"; } ?>"><a href="<?php echo PATH;?>/index.php"><i class="fa fa-dashboard"></i> <span>รายงานสรุป</span></a></li>
      <li><a href="<?php PATH;?>/../payroll"><i class="fa fa-btc"></i> <span>ระบบบัญชี</span></a></li>
      <li class="header">ระบบงาน</li>
      <li class="treeview <?php if($page == 'leave_staff' || $page == 'leave_check' || $page == 'report_leave' ) { echo "active"; }  ?> ">
        <a href="#">
          <i class="fa fa-files-o"></i> 
          <span>ระบบลาออนไลน์พนักงาน</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu ">
          <li class="<?php if($page == 'leave_staff') { echo "active"; } ?>"><a href="<?php echo PATH;?>/pages/leave/leave_staff.php"><i class="fa fa-circle-o"></i>การลาของพนักงาน</a></li>
          <li class="<?php if($page == 'leave_check') { echo "active"; } ?>"><a href="<?php echo PATH;?>/pages/leave/leave_check.php"><i class="fa fa-circle-o"></i>รายการลาย้อนหลัง</a></li>
          <li class="<?php if($page == 'report_leave') { echo "active"; } ?>"><a href="<?php echo PATH;?>/pages/leave/report_leave.php"><i class="fa fa-circle-o"></i>สรุปการลาของพนักงาน</a></li>
        </ul>
      </li>

      <li class="<?php if($page == 'holiday') { echo "active"; } ?> "><a href="<?php echo PATH;?>/pages/holiday_system/holiday.php"><i class="fa fa-calendar"></i> <span>ปฏิทินวันหยุด</span></a></li>

      <li class="treeview <?php if($page == 'register_add' || $page == 'register_staff' ) { echo "active"; } ?> ">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>สมาชิก</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu ">
          <li class="<?php if($page == 'register_add') { echo "active"; } ?>"><a href="<?php echo PATH;?>/pages/register/index.php"><i class="fa fa-circle-o"></i>เพิ่มสมาชิก</a></li>
          <li class="<?php if($page == 'register_staff') { echo "active"; } ?>"><a href="<?php echo PATH;?>/pages/register/register_staff.php"><i class="fa fa-circle-o"></i>พนักงาน</a></li>
        </ul>
      </li>
      <li class="header">รายระเอียด</li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

