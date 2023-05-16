<?php
session_start();
?>
<html>
<head>
    <title>Password dimenticata?</title>
</head>
<body>
    <?php
    if(isset($_SESSION['email'])){
        if(!isset($_POST['invia'])){
    ?>
    <form action="" method="post">
        Password: <input type="password" name="pass1"/><br />
        Ripeti password: <input type="password" name="pass2" /><br />
        <input type="submit" name="invia" value="RECUPERA PASSWORD" />
    </form>
    <?php
        } else {
            $pass1=$_POST['pass1'];
            $pass2=$_POST['pass2'];
            if($pass1=="" || $pass2=="")
                echo "Non lasciare campi vuoti";
            elseif($pass1!=$pass2)
                echo "Le password devono coincidere";
            else{
                $email=$_SESSION['email'];
                include("connection.php");
                $sql = mysqli_query($conn, "SELECT * FROM utenti WHERE Email='$email'");
                if($sql){
                    $pass1 = md5($pass1);
                    $update_db=mysqli_query($conn, "UPDATE utenti SET Password='$pass1' WHERE Email='$email'");
                    if($update_db){
                        echo "Password Aggiornata";
                        echo "<br><a href='index.php'>HOME</a>";
                    }else {
                        echo "Errore nel recupero password: " . mysqli_error($conn);
                    }
                } else {
                    echo "Errore nella query: " . mysqli_error($conn);
                }
            }
        }
    } else {
        echo "Non puoi visualizzare questa pagina";
    }
    ?>
</body>
</html>