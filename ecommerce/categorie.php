<?php
include("connection.php");
session_start();
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
<!----------featured categories------------
<div class="categories">
   <div class="small-container">
   <div class="row">
      <div class="col-3">
      <img src="img/bianca.jpg">
      </div>
      <div class="col-3">
      <img src="img/dasparo.jpg">
      </div>
      <div class="col-3">
      <img src="img/dafuoco.jpg">
      </div>
      <div class="col-3">
      <img src="img/esplosivi.jpg">
      </div>
      <div class="col-3">
      <img src="img/batteriologica.jpg">
      </div>
   </div>
   </div>
   
</div>-->

   <div class="small-container">
     <div class="row row-2">
        <h2>Tutti i prodotti</h2>
        <select>
            <option>Casuale</option>
            <option>Ordina per prezzo</option>
            <option>Ordina per popolarità</option>
            <option>Ordina in base alla valutazione</option>
            <option>Ordina per sconto</option>
</select>
     </div>
      <div class="row">
       <?php  
      $categoria = $_GET["categoria"];

include("connectionDBEcommerce.php");

$sql = "SELECT * FROM ARTICOLI JOIN categorie ON articoli.IdCategoria=categorie.Idc WHERE categorie.Tipo='$categoria'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $articoli = $row['Id'];
        echo "<div class='col-4'>
            <a href='dettagliProdotto.php?id=$articoli'>
            <img src='img/prodotto-" . $row["Id"] . ".jpg' alt='Product Image'>
            </a>
            <a href='#'>" . $row["Titolo"] . "</a>
            <div class='rating'>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star-o'></i>
            </div>";
            if ($row["Sconto"] != 0)
            echo "<p><s>€" . $row["Prezzo"] . "</s></p><b> €" . round($row["Prezzo"] * (100 - $row["Sconto"]) / 100, 2) . "</b><br>";
            else
                echo "<p>€" . $row["Prezzo"] . "</p><br>";

            if ($row["Pezzi"] > 0)
                echo "<a class='btn' href='checkout.php?id=" . $row["Id"] . "'>Compra Ora</a>";
            else
                echo "<a class='btn soldout'>Sold Out</a>";
            echo "</div>";
            

         
      }
   }
       
?>
     </div>
        



<!--------------------fine------------->
<section id="contatti">
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
               <h3>Contatti:</h3>
               <ul>
                  <li>Telefono: +39 2637483948</li>
                  <li>Indirizzo: Via Nino Bixio</li>
                  <li>Paese: Italia</li>
                  <li>Civico: 5</li>
                  <li>Mail: WarZon@gmail.com</li>
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
      </section>
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


</body>
