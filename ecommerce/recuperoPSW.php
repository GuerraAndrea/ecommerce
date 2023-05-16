<?php
session_start();

if(!isset($_POST['recupero'])) {
    // rest of your code here
?>
<html>
<head>
	<title>Password dimenticata?</title>
</head>
<body>
    
        <form action="" method="post">
            E-mail: <input type="text" name="email" /><br/>
            <input type="submit" name="recupero" value="RECUPERA PASSWORD"/>
    </form>
        <?php
    } else {
        $email=$_POST['email'];
        if($email=="")
            echo "Non lasciare vuoto il campo";
        else{
        include("connection.php");
       $sql = mysqli_query($conn, "SELECT * from utenti WHERE Email='$email'");
       if($sql){
          $num=mysqli_num_rows($sql);
          if($num >0){
              
              $_SESSION['email']= $email;
              echo "<a href='new_password.php'>Prosegui per recuperare la password</a>";
          }else
             echo "E-mail inesistente";
       } else {
          echo "Errore nella query: " . mysqli_error($conn);
       }           
    }
}
?>