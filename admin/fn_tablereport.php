<?php
if(@$_POST['search_year'] && @$_POST['search_mounth']) {
  $search_year = $_POST['search_year'];
  $search_mounth  = $_POST['search_mounth'];

  $sql_re = "SELECT *  FROM sick_leave WHERE date_format(dates, '%m %Y')='$search_mounth $search_year' AND fistname = '".$row_m['fistname']."' ";

  if($_POST['search_year'] == "all" && $_POST['search_mounth'] ) {
        // echo 'เดือน';

    $sql_re = "SELECT *  FROM sick_leave WHERE date_format(dates, '%m ')='$search_mounth' AND fistname = '".$row_m['fistname']."'  ";
  }
  if($_POST['search_mounth'] == "all" && $_POST['search_year']) {
        // echo 'ปี';

    $sql_re = "SELECT *  FROM sick_leave WHERE date_format(dates, '%Y ')='$search_year' AND fistname = '".$row_m['fistname']."' ";
  }
  if($_POST['search_year'] == "all" && $_POST['search_mounth'] == "all" ) {
        // echo 'ทั้งหมด';

    $sql_re = "SELECT *  FROM sick_leave WHERE fistname = '".$row_m['fistname']."' ";
  }
  if($_POST['search_year'] == date('Y') && $_POST['search_mounth'] == date('Y')  ) {
        // echo 'เดือน ปี ปัจจุบัน';

    $sql_re = "SELECT *  FROM sick_leave WHERE date_format(dates, '%m %Y') = '$search_mounth $search_year' AND fistname = '".$row_m['fistname']."' ";
  }  
} else {
  $sql_re = "SELECT *  FROM sick_leave WHERE MONTH(dates) = MONTH(now()) AND fistname = '".$row_m['fistname']."' ORDER BY `sick_leave`.`dates` DESC ";
} 
?>