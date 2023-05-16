<?php
include("connection.php");
session_start();

if (isset($_GET['venditore']) && $_GET['venditore'] == 1) {
    //FARE CONTROLLO CARTE
    $sql = $conn->prepare("UPDATE utenti SET Venditore = ? WHERE Id = ?");
    $sql->bind_param('ii', $_GET["venditore"], $_SESSION["ID"]);
    $sql->execute();
}

?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prodotti</title>
	<meta name="description" content="">  
	<meta name="author" content="">

   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 	<!-- CSS
   ================================================== -->
   <link rel="stylesheet" href="css/style.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">   

   <!-- script
   ================================================== -->   
	<!--<script src="js/modernizr.js"></script>
	<script src="js/pace.min.js"></script>-->
   <script src="funzioni.js"></script>

   <!-- favicons
	================================================== -->
	<link rel="icon" type="image/png" href="mirino5.png">
  
</head>
<body>


   

   <div class="container">
   <div class="navbar">
      <div class="logo">
         <img src="logo2.png" width="125px">
      </div>
      <nav>
         <ul id="MenuItems">
            <li><a href="index.php">Home</a></li>
            <li><a href="prodotti.php">Prodotti</a></li>
            <li class="dropdown">
            <a href="#">Categoria</a>
            <div class="dropdown-menu">
            <?php
            
            include("connectionDBEcommerce.php");
        $sql = "SELECT Tipo FROM categorie";
         $result=$conn->query($sql);

         if($result->num_rows>0) {
            while($row =$result->fetch_assoc()){
               $categoria = $row['Tipo'];
               echo "
                  <a href='categorie.php?categoria=$categoria'>$categoria</a>
                  
   
                  ";
                  

               
            }
         }
         ?>
              
            </div>
         </li>
            <li><a href="#contatti">Contatti</a></li>
            <li class="dropdown">
           
            
            <?php
                            if (isset($_SESSION["Username"])) {
                                echo "<a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown'>" . $_SESSION["Username"] . "</a>
                                <div class='dropdown-menu'>
                                    <a href='my-account.php' class='dropdown-item userDropdown'>My Account</a>
                                    <a href='index.php?msg=Logout successfully!&type=danger' class='dropdown-item userDropdown'>Logout</a>
                                </div>";
                            } else {
                                echo "<a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown'>Profilo</a>
                                <div class='dropdown-menu'>
                                    <a href='account.php' class='dropdown-item userDropdown'>Login</a>
                                    <a href='account.php' class='dropdown-item userDropdown'>Register</a>
                                </div>";
                            }
                            ?>
                            
                           </li>
         
         </ul>
      </nav>
      <a href="carrello.php" class="btn cart">
                            <i class="fa fa-shopping-cart"></i>
                            <?php
                            if (isset($_SESSION["IDCarrello"])) {
                                $sql = "SELECT COUNT(*) FROM contenuto JOIN carrello
                                ON contenuto.IdCarrello = carrello.Id
                                WHERE carrello.Id = '" . $_SESSION["IDCarrello"] . "'";

                                $result = $conn->query($sql);

                                $row = $result->fetch_assoc();
                                $n = $row["COUNT(*)"];
                            } else if (isset($_SESSION["IDCarrelloOspite"])) {
                                $sql = "SELECT COUNT(*) FROM contenuto JOIN carrello
                                ON contenuto.IdCarrello = carrello.Id
                                WHERE carrello.Id = '" . $_SESSION["IDCarrelloOspite"] . "'";

                                $result = $conn->query($sql);

                                $row = $result->fetch_assoc();
                                $n = $row["COUNT(*)"];
                            } else
                                $n = 0;
                            echo "<span>(" . $n . ")</span>"
                            ?>
                        </a>
      <img src="img/menu.png" class="menu-icon" onclick="menutoggle()">
</div>

</div>
</div>
<!----------------dettagli carrello--------------->

                            <h4><b>Account:</b></h4>

                            <?php
$sql = $conn->prepare("SELECT Venditore FROM utenti WHERE Id = ?");
$sql->bind_param('i', $_SESSION["ID"]);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row["Venditore"] == 1) {
        $sql = $conn->prepare("SELECT articoli.Id, Titolo, Prezzo, Sconto, Pezzi, Condizione, Tipo FROM articoli JOIN categorie ON articoli.IdCategoria=categorie.Idc WHERE Venditore = ?");
        $sql->bind_param('s', $_SESSION["Username"]);
        $sql->execute();
        $result = $sql->get_result();
        echo "<table class='table table-bordered'>
            <thead class='thead-dark'>
                <tr>
                    <th>Id</th>
                    <th>Titolo</th>
                    <th>Prezzo</th>
                    <th>Sconto</th>
                    <th>Pezzi</th>
                    <th>Condizione</th>
                    <th>Categoria</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
               ";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['Id'] . "</td>
                        <td>" . $row['Titolo'] . "</td>
                        <td>" . $row['Prezzo'] . "</td>
                        <td>" . $row['Sconto'] . "</td>
                        <td>" . $row['Pezzi'] . "</td>
                        <td>" . $row['Condizione'] . "</td>
                        <td>" . $row['Tipo'] . "</td>
                        <td>
                            <button onclick='toDeleteArticle(" . $row['Id'] . ")' class='btn'><i class='bi bi-trash'></i></button>
                            
                            
                          
                        </td>
                    </tr>";
            }
            echo "</tbody>
            </table>
            <button onclick='toAddArticle()' class='btn'>AGGIUNGI</button>";
        } else {
            echo "Sorry, service is not available...";
        }
    }
}
?>




    

<!--------------------fine------------->
   <div class="fine">
      <div class="container">
         <div class="row">
            <div class="fine-col-1">
               <h3>Scarica La Nostra App</h3>
               <p>Scarica l'App disponibile su ios e Android.</p>
               <div class="app-logo">
                  <img src="img/play-store.png">
                  <img src="img/app-store.png">
               </div>
            </div>
            <!--<div class="fine-col-2">
               <img src="logo3.png">
               <p>bwbdfdidyuwdbayufyu</p>
            </div>-->
            <div class="fine-col-3">
               <h3>Link Utili:</h3>
               <ul>
                  <li>Coupon</li>
                  <li>Coupon</li>
                  <li>Coupon</li>
                  <li>Coupon</li>
               </ul>
            </div>
            <div class="fine-col-4">
               <h3>Seguiteci:</h3>
               <ul>
                  <li>Facebook</li>
                  <li>Instagram</li>
                  <li>Twitter</li>
                  <li>Youtube</li>
               </ul>
            </div>
         </div>
         <hr>
         <p class="copyright">Copyright 2023 - Guerra Andrea</p>
      </div>
</div>
  <!-------js togglemenu---------------> 
      <script>
         var MenuItems=document.getElementById("MenuItems");
         MenuItems.style.maxHeight="0px";
         function menutoggle(){
            if(MenuItems.style.maxHeight=="0px")
            {
               MenuItems.style.maxHeight="200px";
            }else{
               MenuItems.style.maxHeight="0px";
            }
         }
         </script>

 
<?php
    if (isset($_GET['msg']) && isset($_GET['type'])) {
        $type = $_GET["type"];
        $msg = $_GET['msg'];
        echo "<script>caricaPopup('$msg', '$type')</script>";
    }
    ?>

</body>
</html>
