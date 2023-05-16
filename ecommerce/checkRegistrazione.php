<?php
include("connection.php");


$password = md5($_POST["PasswordReg"]);

  
  $email = $_POST["e-mail"];
  $username = $_POST["Username2"];

  //seleziono tutti gli username presenti nel database per controllare se già presente
  $sql = "SELECT Username FROM utenti";
  $result = $conn->query($sql);

  //controllo
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc())
      if ($username == $row["Username"]) {
        header("location:account.php?msg=Username già in uso!&type=warning");
        exit;
      }
  }

  //nuovo utente
  $sql = $conn->prepare("INSERT INTO utenti ( Username, Email, Password) VALUES (?,?,?)");
  $sql->bind_param('sss',  $username, $email, $password);
  if ($sql->execute() === true) {
    //se creato correttamente l'utente creo un suo carrello tramite l'id
    $sql = "SELECT Id FROM utenti WHERE Username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id = $row["Id"];

    
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  header("location:account.php?msg=Registered successfully!&type=success");

