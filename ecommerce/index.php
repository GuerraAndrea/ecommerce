<?php
 include ("connection.php");
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
	<title>WarZon</title>
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

   <?php

    //Logout
    if (isset($_GET['msg']) && $_GET['msg'] == "Logout successfully!") {
        unset($_SESSION["ID"]);
        unset($_SESSION['Username']);
        unset($_SESSION["IDCarrello"]);
       
    }
    //se presente cookie lo carico
    
  if (isset($_COOKIE["IDCarrelloOspite"])) {
      $_SESSION["IDCarrelloOspite"] = $_COOKIE["IDCarrelloOspite"];
  }

    
    ?>

</head>
<body>


   <div class="header">

   <div class="container">
   <div class="navbar">
      <div class="logo">
         <img src="logo2.png" width="125px">
      </div>
      
      <nav>
         <ul>
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
                                    <a href='myAccount.php' class='dropdown-item userDropdown'>My Account</a>
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
<div class="row">
   <div class="col-2">
      <h1>Dai Al Tuo Arsenale<br>Un Nuovo Stile!</h1>
      <p>Un buon arsenale deve essere ben fornito.<br> Qui puoi acquistare
      tutte le armi che vuoi<br>per essere preparato ad ogni evenienza.<br>
      <a href="prodotti.php" class="btn">Esplora ora &#8594;<!--freccia in hex--></a>
   </div>
   <div class="col-2">
      <img src="img/soldato.png" alt="">
   </div>
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
<!-----------prodotti piu venduti---------------->
   <div class="small-container">
      <h2 class="title">Più venduti</h2>
      <div class="row">
         <?php
         $sql="SELECT articoli.Id, Titolo,Prezzo,Sconto,Pezzi FROM articoli LIMIT 4";
         $result=$conn->query($sql);

         if($result->num_rows>0) {
            while($row =$result->fetch_assoc()){
              
               echo "<div class='col-4'>
                  <a href='dettagliProdotto.php?id=" . $row["Id"] . "&q=1'>
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
      <h2 class="title">Ultimi Arrivi</h2>
      <div class="row">
      <?php
         $sql="SELECT articoli.Id, Titolo,Prezzo,Sconto,Pezzi FROM articoli  ORDER BY RAND() LIMIT 2,5";
         $result=$conn->query($sql);

         if($result->num_rows>0) {
            while($row =$result->fetch_assoc()){
              
               echo "<div class='col-4'>
                  <a href='dettagliProdotto.php?id=" . $row["Id"] . "&q=1'>
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
   </div>
<!----------------offerta---------------->
<div class="offer">
    <div class="small-container">
        <div class="row">
            <?php
            $sql = "SELECT Id, Titolo, Prezzo, Sconto, Pezzi, Descrizione FROM articoli LIMIT 4,1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $articoli = $row['Id'];
                    echo "<div class='col-2'>
                        <a href='dettagliProdotto.php?articoli=$articoli'>
                            <img src='img/prodotto-" . $row["Id"] . ".png' class='offer-img' alt='Product Image'>
                        </a>
                    </div>
                    <div class='col-2'>
                        <p>Offerta esclusiva su WarZone.</p>
                        <h1>" . $row["Titolo"] . "</h1>
                        <small>" . $row["Pezzi"] . " disponibili</small><br>
                        <small>". $row["Descrizione"] . "</small><br>
                        <a href='dettagliProdotto.php?articoli=$articoli' class='btn'>Compralo ora &#8594;</a>
                    </div>";
                }
            } else {
                echo "<p>Nessun prodotto disponibile al momento.</p>";
            }
            ?>
        </div>
    </div>
</div>
<!------------testimoni------------->
         <div class="testimonial">
            <div class="small-container">
               <div class="row">
                  <div class="col-3">
                  <i class="fa fa-quote-left"></i>
                     <p>gsgsfadfhudhuvbduvbusdbv
                        vwbviudbvubuibviusbvubuv
                        vuwbvuibvuibuidbvubdvub
                     </p>
                     <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                     </div>
                     <img src="img/kim.jpg" alt="">
                     <h3>Kim Jong-Un</h3>
                  </div>
                  <div class="col-3">
                  <i class="fa fa-quote-left"></i>
                     <p>gsgsfadfhudhuvbduvbusdbvu
                        vwbviudbvubuibviusbvubuv
                        vuwbvuibvuibuidbvubdvubu
                     </p>
                     <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                     </div>
                     <img src="img/putin.jpg" alt="">
                     <h3>Vladimir Putin</h3>
                  </div>
                  <div class="col-3">
                  <i class="fa fa-quote-left"></i>
                     <p>gsgsfadfhudhuvbduvbusdbvub
                        vwbviudbvubuibviusbvubuvibsivb
                        vuwbvuibvuibuidbvubdvubuvbiu
                     </p>
                     <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                     </div>
                     <img src="img/xi.jpg" alt="">
                     <h3>Xi Jinping</h3>
                  </div>
               </div>
            </div>
<!-----------------brands------------>
<div class="brands">
   <div class="small-container">
      <div class="row">
         <div class="col-5">
            <a href="https://www.lockheedmartin.com/"><img src="img/lockheed.png"></a>
         </div>
         <div class="col-5">
           <a href="https://www.rtx.com/"> <img src="img/ray.png"></a>
         </div>
         <div class="col-5">
           <a href="https://www.boeing.com/defense/weapons/"> <img src="img/boeing.png"></a>
         </div>
         <div class="col-5">
           <a href="https://www.baesystems.com/en-us/our-company/inc-businesses/platforms-and-services/locations/sweden"> <img src="img/bae.png"></a>
         </div>
         <div class="col-5">
            <a href="https://thechinaproject.com/company-profiles/avic/"><img src="img/avic.png"></a>
         </div>
      </div>
   </div>
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
                  <a href="https://play.google.com/store/games"><img src="img/play-store.png"></a>
                  <a href="https://www.apple.com/it/app-store/"><img src="img/app-store.png"></a>
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
                  <li>Indirizzo: Via Nino Bixio, 5</li>
                  <li>Città: Milano (IT)</li>
                  <li><a href="https://www.google.com/maps/place/Via+Nino+Bixio,+5,+20129+Milano+MI/@45.4722336,9.2076181,17z/data=!3m1!4b1!4m6!3m5!1s0x4786c6be4fd0a1ad:0x30c368c214b4e290!8m2!3d45.4722336!4d9.2076181!16s%2Fg%2F11c4kc8l9j" 
                  style="color: #fff">Mappa</a></li>
                  <li>Mail: WarZon@gmail.com</li>
               </ul>
            </div>
            <div class="fine-col-4">
               <h3>Seguiteci:</h3>
               <ul>
                  <li><a href="https://it-it.facebook.com/">Facebook</a></li>
                  <li><a href="https://www.instagram.com/">Instagram</a></li>
                  <li><a href="https://twitter.com/?lang=it">Twitter</a></li>
                  <li><a href="https://www.youtube.com/">Youtube</a></li>
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
