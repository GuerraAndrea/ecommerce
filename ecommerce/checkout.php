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
<div class="small-container cart-page">

            <form action="checkOrdine.php" method="POST">
                <div class="row">
                   
                                <h2>Indirizzo di fatturazione</h2>
                        </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nome:</label>
                                        <input class="form-control" type="text" placeholder="Nome" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Cognome:</label>
                                        <input class="form-control" type="text" placeholder="Cognome" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail:</label>
                                        <input class="form-control" type="text" placeholder="E-mail" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Numero di telefono:</label>
                                        <input class="form-control" type="text" placeholder="+39" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Indirizzo:</label>
                                        <input class="form-control" type="text" name="address" placeholder="Via" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>Città:</label>
                                        <input class="form-control" type="text" placeholder="Città" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Paese:</label>
                                        <input class="form-control" type="text" placeholder="Paese" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>CAP:</label>
                                        <input class="form-control" type="text" placeholder="cap" required>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="check" id="shipto">
                                            <label class="custom-control-label" for="shipto">Spedire a indirizzo diverso</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="shipping-address">
                                <center>
                                <h2>Indirizzo di spedizione:</h2><br>
                                <center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Indirizzo:</label>
                                        <input class="form-control" type="text" name="addressB" placeholder="Via">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>Città:</label>
                                        <input class="form-control" type="text" placeholder="Città">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Paese:</label>
                                        <input class="form-control" type="text" placeholder="Paese">
                                    </div>
                                    <div class="col-md-6">
                                        <label>CAP:</label>
                                        <input class="form-control" type="text" placeholder="cap"><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="col-lg-4">
                        <div class="checkout-inner">
                            <div class="checkout-summary">
                                <center>
                                <h1>Totale Carrello</h1>
                                <?php
                                $totPrice = 0;
                                if (isset($_SESSION["IDCarrello"]))
                                    $sql = "SELECT Titolo, Prezzo, Sconto, Quantità FROM contenuto JOIN articoli ON contenuto.IdArticolo = articoli.Id WHERE IDCarrello = '" . $_SESSION["IDCarrello"] . "'";
                                else if (isset($_SESSION["IDCarrelloOspite"]))
                                $sql = "SELECT Titolo, Prezzo, Sconto, Quantità FROM contenuto JOIN articoli ON contenuto.IdArticolo = articoli.Id WHERE IDCarrello = '" . $_SESSION["IDCarrelloOspite"] . "'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row["Sconto"] != 0) {
                                            $discountedPrice = round($row["Prezzo"] * (100 - $row["Sconto"]) / 100, 2)  * $row["Quantità"];
                                            $totPrice += $discountedPrice;
                                            echo "<p>" . $row["Titolo"] . "<br>Prezzo:<span><s> €" . $row["Prezzo"] * $row["Quantità"] . "</s> $$discountedPrice</span></p>";
                                        } else {
                                            $totPrice += $row["Prezzo"] * $row["Quantità"];
                                            echo "<p>" . $row["Titolo"] . "<span>$" . $row["Prezzo"] * $row["Quantità"] . "</span></p>";
                                        }
                                    }
                                    echo "<p class='sub-total'>Prezzo Totale<span> €$totPrice</span></p>
                                        <p class='ship-cost'>Costo di spedizione<span> €10</span></p>
                                        <h2>Prezzo finale<span> €" . ($totPrice + 10) . "</span></h2><br>";
                                }
                                ?>
                                <center>


                            </div>

                            <div class="checkout-payment">
                                <div class="payment-methods">
                                    <center>
                                    <h1>Metodi di pagamento</h1><br>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="radio" value="Paypal" class="custom-control-input" id="payment-1" name="payment">
                                            <label class="custom-control-label" for="payment-1">PayPal</label>
                                        </div>
                                        <div class="payment-content" id="payment-1-show">
                                            <p class="pl-2">
                                                <?php
                                                //SE LOGGATO CARICO GLI ACCOUNT PAYPAL ASSOCIATI
                                                if (isset($_SESSION["ID"])) {
                                                    $sql = $conn->prepare("SELECT * FROM metodi_pagamento WHERE IdUtente = ? AND Tipo = 'PayPal'");
                                                    $sql->bind_param('i', $_SESSION["ID"]);
                                                    $sql->execute();
                                                    $result = $sql->get_result();

                                                    if ($result->num_rows > 0) {
                                                        echo "<b>Account paypal associati:<br></b>";
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<input type='radio' value='" . $row["Email"] . "' autocomplete='off'>
                                                            <label>" . $row["Email"] . "</label><br>";
                                                        }
                                                    }
                                                }
                                                ?>
                                                <b>Nuovo paypal account:<br></b>
                                                E-mail: <input type="text" class="bg-dark text-white rounded form-control">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="radio" value="Credit Card" class="custom-control-input" id="payment-2" name="payment">
                                            <label class="custom-control-label" for="payment-2">Carta di credito</label>
                                        </div>
                                        <div class="payment-content" id="payment-2-show">
                                            <p class="pl-2">
                                                <?php
                                                //SE LOGGATO CARICO GLI ACCOUNT PAYPAL ASSOCIATI
                                                if (isset($_SESSION["ID"])) {
                                                    $sql = $conn->prepare("SELECT * FROM metodi_pagamento WHERE IdUtente = ? AND Tipo = 'Carta di credito'");
                                                    $sql->bind_param('i', $_SESSION["ID"]);
                                                    $sql->execute();
                                                    $result = $sql->get_result();

                                                    if ($result->num_rows > 0) {
                                                        echo "<b>Carte di credito associate:<br></b>";
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<input type='radio' value='" . $row["Id"] . "'  autocomplete='off'>
                                                            <label>Card Number: " . substr($row["NumeroCarta"], 0, 4) . " " . substr($row["NumeroCarta"], 4, 4) . " **** ****</label><br>";
                                                        }
                                                    }
                                                }
                                                ?>
                                                <b>Nuova carta di credito:</b><br>
                                                Numero Carta &nbsp&nbsp&nbsp<input type="text" class="bg-dark text-white rounded form-control" maxlength="16">
                                                Nome sulla carta &nbsp&nbsp<input type="text" class="bg-dark text-white rounded form-control">
                                                Data di scadenza <input type="text" class="bg-dark text-white rounded form-control" maxlength="7" placeholder="01/2023">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="radio" value="Cash on Delivery" class="custom-control-input" id="payment-5" name="payment">
                                            <label class="custom-control-label" for="payment-5">Pagamento alla consegna</label>
                                        </div>
                                        <div class="payment-content" id="payment-5-show">
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout-btn">
                                    <center>
                                    <center>
                                    <button class="btn checkout">Effettua Ordine</button>
                                    <center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>















    

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
