<?php 
session_start();

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
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Page Title</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="css/icofont.min.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap&subset=thai" rel="stylesheet"> 
</head>
<style>

  @import url('https://fonts.googleapis.com/css?family=Abel');

  html, body {
    background: #FCEEB5;
    font-family: Kanit, Arial, Verdana, sans-serif;
  }

  .center {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
  }

  .image {
    opacity: 1;
    display: block;
    width: 30%;
    height: 100px;
    transition: .5s ease;
    backface-visibility: hidden;
  }

  .middle {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
  }

  .container2:hover .image {
    opacity: 0.3;
  }

  .container2:hover .middle {
    opacity: 1;
  }

  .text {

    color: black;
    font-size: 16px;
    padding: 16px 32px;
  }
</style>
<body>

  <?php
  require('conn_main.php');



  $sql = mysqli_query($conn, "SELECT * FROM member WHERE username = '".$_GET['user']."'");
  $row = mysqli_fetch_assoc($sql);

  $sqlSummer = mysqli_query($conn, "SELECT sum(day_num) as SummerDay, count(sick) as CountSummerDay FROM sick_leave WHERE sick = 'ลาพักร้อน' AND fistname = '".$row['fistname']."' ");
  $rowSummer = mysqli_fetch_assoc($sqlSummer);

  $sqlSick = mysqli_query($conn, "SELECT sum(day_num) as SickDay, count(sick) as CountSickDay FROM sick_leave WHERE sick = 'ลาป่วย' AND fistname = '".$row['fistname']."' ");
  $rowSick = mysqli_fetch_assoc($sqlSick);

    $sqlKit = mysqli_query($conn, "SELECT sum(day_num) as KitDay, count(sick) as CountKitDay FROM sick_leave WHERE sick = 'ลากิจ' AND fistname = '".$row['fistname']."' ");
  $rowKit = mysqli_fetch_assoc($sqlKit);
  ?>
  <?php 
  $edit = isset($_GET["edit"]) ? $_GET["edit"] : "";
  if(!$edit == $_SESSION['user']) { ?>
    <a href="index.php" class="text-primary h1 p-2"><i class="icofont-arrow-right icofont-rotate-180"></i></a>  
    <div class="center">
      <div class="row" style="box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);" >
        <div class="col-md-4">
          <div class="bg-danger" style="height:350px; width:250px;">
            <div class="text-center"><br/>
              <div>
                <span class="badge badge-dark" style="font-size:1rem;">
                  <?php if($row['department'] == "Accounting") { ?>
                    ฝ่ายบัญชี
                  <?php } elseif($row['department'] == "Programer") { ?>
                    โปรแกรมเมอร์
                  <?php } elseif($row['department'] == "Marketing") { ?>
                    ฝ่ายการตลาด
                  <?php } elseif($row['department'] == "Graphic") { ?>
                    ฝ่ายกราฟิค
                  <?php } ?>
                </span>
              </div>
              <div class="mt-lg-5">
                <img src="../images/user/<?php echo $row['image_user']; ?>" width="50%" height="120" class="rounded-circle">
              </div><br/>
              <div class="mt-xl-5">
                <span class="badge badge-dark" style="font-size:1rem;">
                 <?php echo $row['nickname'];?>
               </span>
             </div><br/>
           </div>
         </div>
       </div>
       <div class="col-md-4">
        <div class="bg-light"  style="height:350px; width:500px;">
          <div class="text-center "><br/>
            <h2><?php echo $row['fistname'].'&nbsp;'.$row['lastname'];?></h2>
          </div>
          <div class="row p-4">
            <div class="col-md-6 mb-3">
              ชื่อเล่น&nbsp;<?php echo $row['nickname']; ?>
            </div>
            <div class="col-md-6">
              วันเกิด&nbsp;<?php echo DateThai($row['birthday']); ?>
            </div>
            <div class="col-md-12 mb-3">
              <?php if($row['department'] == "Accounting") { ?>
                <span>ตำแหน่ง&nbsp;ฝ่ายบัญชี</span>
              <?php } elseif($row['department'] == "Programer") { ?>
                <span>ตำแหน่ง&nbsp;โปรแกรมเมอร์</span>
              <?php } elseif($row['department'] == "Marketing") { ?>
                <span>ตำแหน่ง&nbsp;ฝ่ายการตลาด</span>
              <?php } elseif($row['department'] == "Graphic") { ?>
                <span>ตำแหน่ง&nbsp;ฝ่ายกราฟิค</span>
              <?php } ?>
            </div>
            <div class="col-md-12 mb-3">
              อีเมลล์<?php echo $row['email']; ?>
            </div>
            <div class="col-md-12 ">
              ที่อยู่&nbsp;<?php echo $row['address']; ?>
            </div>
          </div>
          <div class="row text-center">
            <!-- ลาป่วย -->
            <div class="col-md-4">
              <div class="row">
                <div class="col-md-12">
                  ลาป่วย
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="font-size:1.5rem;font-weight: bold;">
                  <?php if($rowSick['SickDay'] == 0) { ?>
                    0
                  <?php } else { ?>
                    <?php echo $rowSick['SickDay']; ?>
                  <?php } ?>
                </div>
              </div>
            </div>
            <!-- ลากิจ -->
            <div class="col-md-4">
              <div class="row">
                <div class="col-md-12">
                  ลากิจ
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="font-size:1.5rem;font-weight: bold;">
                  <?php if($rowKit['KitDay'] == 0) { ?>
                    0
                  <?php } else { ?>
                    <?php echo $rowKit['KitDay']; ?>
                  <?php } ?>
                </div>
              </div>
            </div>
            <!-- ลาพักร้อน -->
            <div class="col-md-4">
              <div class="row">
                <div class="col-md-12">
                  ลาพักร้อน
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="font-size:1.5rem;font-weight: bold;">
                 <?php if($rowSummer['SummerDay'] == 0) { ?>
                  0
                <?php } else { ?>
                  <?php echo $rowSummer['SummerDay']; ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <p class="text-center mt-2" style="font-size:30px;"><a href="?edit=<?php echo $_SESSION['user']; ?>" class="text-warning" style="text-decoration: none;"><i class="icofont-edit-alt"></i>&nbsp;แก้ไข</a></p>
</div>
<!-- edit -->
<?php 
} else {
  $sql = mysqli_query($conn, "SELECT * FROM member WHERE username = '".$_GET['edit']."'");
  $row = mysqli_fetch_assoc($sql); 

  ?>
  <a href="edit_profile.php?user=<?php echo $_SESSION['user'];?>" class="text-primary h1 p-2"><i class="icofont-arrow-right icofont-rotate-180"></i></a>  
  <div class="center">
    <div class="bg-light " style="height:auto;width:500px;">
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12 text-center mt-2">

            <div class="container2">
              <img src="../images/user/<?php echo $row['image_user']; ?>" id="upload" class="rounded-circle image mx-auto ">
              <div class="middle">
                <div class="text">อัพโหลด
                  <input type="hidden" name="uploadTofileOld" id="uploadTofileOld" value="<?php echo $row['image_user']; ?>">
                  <input type="file" name="uploadTofile" id="uploadTofile" style="margin-left:140px;"/>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="row mx-auto">
          <div class="col-md-6">
            <label for="Username">username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $row['username'];?>" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>password</label>
            <div class="input-group date">
              <input type="password" id="password" name="password" class="form-control pull-right" value="<?php echo $row['password']; ?>" required>
              <div class="input-group-addon" style="cursor:pointer;">
                <i class="icofont-eye" id="open_pass"></i>
              </div>
            </div>
          </div>
        </div>

      </div>
      <p class="text-center" style="font-size:30px;"><button class="btn btn-primary">ตกลง</button></p>
    </form>
  </div>
  <?php
  $uploadTofileOld = $_POST['uploadTofileOld'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $url = "../images/user/";
  $uploadTofile = $_FILES['uploadTofile']['name'];
  $newfilename = rand(1,99999) . '.' . end(explode(".",$uploadTofile));
  if($_POST){
    if($uploadTofile != '') {
      if(move_uploaded_file($_FILES["uploadTofile"]["tmp_name"],$url.$newfilename)) {
        unlink($url.$row['image_user']);
        $sql = mysqli_query($conn,"UPDATE `member` SET `username` = '$username', password = '$password', image_user = '$newfilename' WHERE `username` = '$username';");
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '0;URL=edit_profile.php?user=$username'>";
      } 
    } else {
     $sql = mysqli_query($conn,"UPDATE `member` SET `username` = '$username', password = '$password', image_user = '$uploadTofileOld' WHERE `username` = '$username';");
     if($sql){
      echo "<META HTTP-EQUIV='Refresh' CONTENT = '0;URL=edit_profile.php?user=$username'>";
    }
  }
}

?>
<?php } ?>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
<script>
  $('#open_pass').click(function(){
    if('password' == $('#password').attr('type')){
     $('#password').prop('type', 'text');
   }else{
     $('#password').prop('type', 'password');
   }
 });
</script>

<script>
  $('div.card').animate({left: 0},'slow');
</script>
<script>
  $('.text').click(function() {
   $('#uploadTofile').click();
 });
</script>

  <!--  <svg width="110" height="110" viewBox="0 0 250 250" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="title desc" class="center">
            <title id="title">Teacher</title>
            <desc id="desc">Cartoon of a Caucasian woman smiling, and wearing black glasses and a purple shirt with white collar drawn by Alvaro Montoro.</desc>
            <style>
            .skin { fill: #eab38f; }
            .eyes { fill: #1f1f1f; }
            .hair { fill: #2f1b0d; }
            .line { fill: none; stroke: #2f1b0d; stroke-width:2px; }
            </style>
            <defs>
              <clipPath id="scene">
                <circle cx="125" cy="125" r="115"/>
              </clipPath>
              <clipPath id="lips">
                <path d="M 106,132 C 113,127 125,128 125,132 125,128 137,127 144,132 141,142  134,146  125,146  116,146 109,142 106,132 Z" />
              </clipPath>
            </defs>
            <circle cx="125" cy="125" r="120" fill="rgba(0,0,0,0.15)" />
            <g stroke="none" stroke-width="0" clip-path="url(#scene)">
              <rect x="0" y="0" width="250" height="250" fill="#b0d2e5" />
              <g id="head">
                <path fill="none" stroke="#111111" stroke-width="2" d="M 68,103 83,103.5" />
                <path class="hair" d="M 67,90 67,169 78,164 89,169 100,164 112,169 125,164 138,169 150,164 161,169 172,164 183,169 183,90 Z" />
                <circle cx="125" cy="100" r="55" class="skin" />
                <ellipse cx="102" cy="107" rx="5" ry="5" class="eyes" id="eye-left" />
                <ellipse cx="148" cy="107" rx="5" ry="5" class="eyes" id="eye-right" />
                <rect x="119" y="140" width="12" height="40" class="skin" />
                <path class="line eyebrow" d="M 90,98 C 93,90 103,89 110,94" id="eyebrow-left" />
                <path class="line eyebrow" d="M 160,98 C 157,90 147,89 140,94" id="eyebrow-right"/>
                <path stroke="#111111" stroke-width="4" d="M 68,103 83,102.5" />
                <path stroke="#111111" stroke-width="4" d="M 182,103 167,102.5" />
                <path stroke="#050505" stroke-width="3" fill="none" d="M 119,102 C 123,99 127,99 131,102" />
                <path fill="#050505" d="M 92,97 C 85,97 79,98 80,101 81,104 84,104 85,102" />
                <path fill="#050505" d="M 158,97 C 165,97 171,98 170,101 169,104 166,104 165,102" />
                <path stroke="#050505" stroke-width="3" fill="rgba(240,240,255,0.4)" d="M 119,102 C 118,111 115,119 98,117 85,115 84,108 84,104 84,97 94,96 105,97 112,98 117,98 119,102 Z" />
                <path stroke="#050505" stroke-width="3" fill="rgba(240,240,255,0.4)" d="M 131,102 C 132,111 135,119 152,117 165,115 166,108 166,104 166,97 156,96 145,97 138,98 133,98 131,102 Z" />
                <path class="hair" d="M 60,109 C 59,39 118,40 129,40 139,40 187,43 189,99 135,98 115,67 115,67 115,67 108,90 80,109 86,101 91,92 92,87 85,99 65,108 60,109" />
                <path id="mouth" fill="#d73e3e" d="M 106,132 C 113,127 125,128 125,132 125,128 137,127 144,132 141,142  134,146  125,146  116,146 109,142 106,132 Z" /> 
                <path id="smile" fill="white" d="M125,141 C 140,141 143,132 143,132 143,132 125,133 125,133 125,133 106.5,132 106.5,132 106.5,132 110,141 125,141 Z" clip-path="url(#lips)" />
              </g>
              <g id="shirt">
                <path fill="#8665c2" d="M 132,170 C 146,170 154,200 154,200 154,200 158,250 158,250 158,250 92,250 92,250 92,250 96,200 96,200 96,200 104,170 118,170 118,170 125,172 125,172 125,172 132,170 132,170 Z"/>
                <path id="arm-left" class="arm" stroke="#8665c2" fill="none" stroke-width="14" d="M 118,178 C 94,179 66,220 65,254" />
                <path id="arm-right" class="arm" stroke="#8665c2" fill="none" stroke-width="14" d="M 132,178 C 156,179 184,220 185,254" />
                <path fill="white" d="M 117,166 C 117,166 125,172 125,172 125,182 115,182 109,170 Z" />
                <path fill="white" d="M 133,166 C 133,166 125,172 125,172 125,182 135,182 141,170 Z" />
                <circle cx="125" cy="188" r="4" fill="#5a487b" />
                <circle cx="125" cy="202" r="4" fill="#5a487b" />
                <circle cx="125" cy="216" r="4" fill="#5a487b" />
                <circle cx="125" cy="230" r="4" fill="#5a487b" />
                <circle cx="125" cy="244" r="4" fill="#5a487b" />
                <path stroke="#daa37f" stroke-width="1" class="skin hand" id="hand-left" d="M 51,270 C 46,263 60,243 63,246 65,247 66,248 61,255 72,243 76,238 79,240 82,243 72,254 69,257 72,254 82,241 86,244 89,247 75,261 73,263 77,258 84,251 86,253 89,256 70,287 59,278" /> 
                <path stroke="#daa37f" stroke-width="1" class="skin hand" id="hand-right" d="M 199,270 C 204,263 190,243 187,246 185,247 184,248 189,255 178,243 174,238 171,240 168,243 178,254 181,257 178,254 168,241 164,244 161,247 175,261 177,263 173,258 166,251 164,253 161,256 180,287 191,278"/> 
              </g>
            </g>
          </svg> -->