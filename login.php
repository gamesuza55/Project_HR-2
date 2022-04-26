<?php
session_start();

include_once "conn.php";
// $username    = mysqli_real_escape_string($conn, $_POST['username']);
// $password    = mysqli_real_escape_string($conn, $_POST['password']);
// $password    = md5($password);
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM member WHERE username = '".$username."' AND password = '".$password."' "; 
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {

    if($username == $row['username'] && $password == $row['password'] && $row['status'] == "admin") {

      $_SESSION['user'] = $username ;
      $_SESSION['status'] = "admin" ;

      echo $row['status'];
    }
    else if($username == $row['username'] && $password == $row['password'] && $row['status'] == "user" && $row['status_user'] == "1") {
      echo 'ลาออกแล้วไม่สามารถเข้าใช้งานได้';
    }

    else if($username == $row['username'] && $password == $row['password'] && $row['status'] == "user" && $row['department'] == "Accounting" && $row['status_user'] == "0") {
      $_SESSION['user'] = $username ;
      $_SESSION['status'] = "user";
      $_SESSION['department'] = "Accounting";

      echo $row['status'];
      echo $row['department'];

    }


    else if($username == $row['username'] && $password == $row['password'] && $row['status'] == "user" && $row['status_user'] == 0) {

      $_SESSION['user'] = $username ;
      echo $_SESSION['status'] = "user" ;


    }


    
  }
}
else { 
  echo '<b>Login Failed</b>';

}
?>
