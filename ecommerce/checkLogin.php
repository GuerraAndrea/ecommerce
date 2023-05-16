<?php
include("connection.php");

session_start();

$username = $_POST['Username2'];
$password = md5($_POST['PasswordLogin']);

$sql = $conn->prepare("SELECT Id, Username, Password FROM utenti WHERE Username = ?  AND Password = ?");
$sql->bind_param('ss', $username, $password);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  //salvo session
  $_SESSION['ID'] = $row['Id'];
  $_SESSION['Username'] = $row['Username'];

 

  header("location:index.php?msg=Logged successfully!&type=success");
} else {
  header("location:account.php?msg=Username e Password non sono corretti!&type=danger");
}
