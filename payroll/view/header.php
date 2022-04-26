<?php  
$sql = mysqli_query($conn, "SELECT COUNT(id_domain) as day FROM domain WHERE DATEDIFF(due_date, now()) = 30 or DATEDIFF(due_date, now()) = 3 "  );
$row_day = mysqli_fetch_assoc($sql);
if($row_day['day'] > 0) {
    $noti_day = '<span class="badge badge-danger text-uppercase" style="position:absolute;right:38px;">'.$row_day['day']
    .'</span>';
    $noti_day_mobile = '<span class="badge badge-danger text-uppercase" style="position:absolute;right:50px;">'.$row_day['day']
    .'</span>';
} else {
    $noti_day = '';
    $noti_day_mobile = '';
}

$sql_user = mysqli_query($conn, "SELECT * FROM member WHERE username = '".$_SESSION['user']."' ");
$row_user = mysqli_fetch_assoc($sql_user);
?>

<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-theme-dark headroom shadow-sm" >
        <div class="container position-relative">
            <a class="navbar-brand mr-lg-5" href="<?php echo PATH;?>">
                <img class="navbar-brand-dark" src="./img/brand/logo-acountTWE-white.svg" alt="Logo light" style="height: 130px;top: -16px;">
                <img class="navbar-brand-light" src="./img/brand/logo-acountTWE-dark.svg" alt="Logo dark">
            </a>
            <!-- toggle nav_global -->
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="<?php echo PATH;?>">
                                <img src="./img/brand/logo-acountTWE-dark.svg" alt="menuimage">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <a href="#navbar_global" role="button" class="fas fa-times" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation"></a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <img src="../images/user/<?php echo $row_user['image_user'];?>" class="rounded-circle" height="150" width="150" alt="profile">
                        </div>
                        <div class="col-12 text-center mt-2">
                            <a href="logout.php" class="nav-link text-danger">ออกจากระบบ</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- toggle nav_notify mobie -->
            <div class="navbar-collapse collapse" id="navbar_notity">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="./index.html">
                                <img src="./img/brand/secondary.svg" alt="menuimage">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <a href="#navbar_global" role="button" class="fas fa-times" data-toggle="collapse" data-target="#navbar_notity" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation"></a>
                        </div>

                    </div>
                </div>
                <div class="navbar-collapse-header collapse">
                    <div class="list-group list-group-flush">
                        <a href="./docs/introduction.html" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                            <span class="icon icon-sm icon-secondary"><i class="fas fa-file-alt"></i></span>
                            <div class="ml-4">
                                <span class="text-dark d-block">Documentation<span class="badge badge-sm badge-secondary ml-2">v1.0</span></span>
                                <span class="small">Examples and guides</span>
                            </div>
                        </a>
                        <a href="https://themesberg.com/contact" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                            <span class="icon icon-sm icon-primary"><i class="fas fa-microphone-alt"></i></span>
                            <div class="ml-4">
                                <span class="text-dark d-block">Support</span>
                                <span class="small">Looking for answers? Ask us!</span>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <!-- toggle nav_notify desktop -->
            <div class="d-flex align-items-center ">
                <div class="navbar-collapse collapse">
                    <ul class="flex-row list-style-none d-none d-sm-flex">
                        <!-- แจ้งเตือน -->
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                                <i class="fas fa-bell" style="font-size:22px;"></i>
                                <?php echo $noti_day; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg" style="min-width:500px;">
                                <div class="col-auto px-0" data-dropdown-content>
                                    <!-- border 3 วัน -->
                                    <div class="border-bottom">
                                        <div class="ml-3 mt-3 mb-3 text-danger">3 วันก่อนครบกำหนด</div>
                                    </div>
                                    <div class="list-group list-group-flush ">
                                        <div class="overflow-scroll">
                                            <?php 
                                            $sql_day3 = mysqli_query($conn, "SELECT * FROM domain WHERE DATEDIFF(due_date,now()) = 3 ");
                                            if(mysqli_num_rows($sql_day3) > 0) {
                                                while($row_day3 = mysqli_fetch_assoc($sql_day3)) {
                                                    ?>
                                                    <a href="domain.php?id_nofi=<?php echo $row_day3['id_domain']; ?>" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                                        <span class="icon icon-sm icon-secondary"><i class="fas fa-clock"></i></span>
                                                        <div class="ml-4">
                                                            <span class="text-dark d-block"><?php echo $row_day3['name_company']; ?><span class="badge badge-sm badge-secondary ml-2">v1.0</span></span>
                                                            <span class="small"><?php echo $row_day3['domain']; ?></span>
                                                        </div>
                                                    </a>
                                                    <?php 
                                                }
                                            } else {
                                                echo '<h3 class="text-center mt-4">ไม่มีการแจ้งเตือน</h3>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- border 3 วัน -->
                                    <div class="border-bottom border-top">
                                        <div class="ml-3 mt-3 mb-3 text-warning">1 เดือนก่อนครบกำหนด</div>
                                    </div>
                                    <div class="list-group list-group-flush ">
                                        <div class="overflow-scroll">
                                            <?php 
                                            $sql_day30 = mysqli_query($conn, "SELECT * FROM domain WHERE DATEDIFF(due_date,now()) = 30 ");
                                            if(mysqli_num_rows($sql_day30) > 0) {
                                                while($row_day30 = mysqli_fetch_assoc($sql_day30)) {
                                                    ?>
                                                    <a href="domain.php?id_nofi30=<?php echo $row_day30['id_domain'];?>" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                                        <span class="icon icon-sm icon-secondary"><i class="fas fa-clock"></i></span>
                                                        <div class="ml-4">
                                                            <span class="text-dark d-block"><?php echo $row_day30['name_company']; ?><span class="badge badge-sm badge-secondary ml-2">v1.0</span></span>
                                                            <span class="small"><?php echo $row_day30['domain']; ?></span>
                                                        </div>
                                                    </a>
                                                <?php } 
                                            } else {
                                                echo '<h3 class="text-center mt-4">ไม่มีการแจ้งเตือน</h3>';
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button" style="padding:0.25rem 0.5rem;">
                                <img src="./../images/user/<?php echo $row_user['image_user'];?>" alt="profile" class="rounded-circle" height="40" width="50" style="opacity:1;">
                                <i class="fas fa-angle-down nav-link-arrow"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                <?php if($_SESSION['status'] == "admin") { ?>
                                    <li><a class="dropdown-item" href="../admin/">Administration</a></li>
                                    <li class="border-bottom"></li>
                                    <li><a class="dropdown-item" href="<?php echo PATH;?>/logout.php">ออกจากระบบ</a></li>
                                <?php } else { ?>
                                    <li><a class="dropdown-item" href="../home.php">Home</a></li>
                                    <li><a class="dropdown-item" href="../user/index.php">ระบบลาออนไลน์</a></li>
                                    <li class="border-bottom"></li>
                                    <li><a class="dropdown-item" href="<?php echo PATH;?>/logout.php">ออกจากระบบ</a></li>
                                <?php }?>
                            </ul>
                        </li>

                    </li>
                </ul>
            </div>
            <!-- button navbar_global -->

            <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbar_notity" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bell" style="font-size:20px;"></i>
                <?php echo $noti_day_mobile; ?>
            </button>
            <!-- button navbar_notity -->

            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

            </button>
        </div>
    </div>
</nav>
</header>

