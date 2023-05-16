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
   <?php

//Logout
if (isset($_GET['msg']) && $_GET['msg'] == "Logout successfully!") {
    unset($_SESSION["ID"]);
    unset($_SESSION['Username']);
   
}


?>
</head>
<body>


   

   <div class="container">
   <div class="navbar">
      <div class="logo">
         <a href="index.php"><img src="logo2.png" width="125px"></a>
      </div>
      <nav>
         <ul id="MenuItems">
            <li><a href="index.php">Home</a></li>
            <li><a href="prodotti.php">Prodotti</a></li>
            <li><a href="">Categoria</a></li>
            <li><a href="">Contatti</a></li>
            <li><a href="">Profilo</a></li>
         </ul>
      </nav>
      <a href="carrello.php"><img src="img/cart.png" width="30px" height="30px" ></a>
      <img src="img/menu.png" class="menu-icon" onclick="menutoggle()">
</div>

</div>
<!----------------pagina account----------->
<div class="account-page">
   <div class="container">
      <div class="row">
         <div class="col-2">
            <img src="img/soldato.png" width="100%">
      </div>

      <div class="col-2">
            <div class="form-container">
               <div class="form-btn">
                  <span onclick="login()">Accedi</span>
                  <span onclick="register()">Resgistrati</span>
                  <hr id="Indicator">
               </div>
               <form action="checkLogin.php" method="post" id="LoginForm">
                  <input type="text" placeholder="Username" name="Username2">
               
                  <div class="password-container">
    <input type="password" placeholder="Password" name="PasswordLogin" id="password-field" >
    <label for="password-field" id="password-toggle">
      <i class="fa fa-eye-slash" aria-hidden="true"></i>
      <!-- Add the icon you want to display here -->
    </label>
  </div>

                  <button type="submit" class="btn">Accedi</button>
                  <a href="recuperoPSW.php">Password dimenticata?</a>
</form>

<form action="checkRegistrazione.php" method="post" id="RegForm">
                  <input type="text" placeholder="Username" name="Username2">
                  <input type="email" placeholder="Email" name="e-mail">
                  <div class="password-container2">
    <input type="password" placeholder="Password" name="PasswordReg" id="password-field2" >
    <label for="password-field2" id="password-toggle2">
      <i class="fa fa-eye-slash" aria-hidden="true"></i>
      <!-- Add the icon you want to display here -->
    </label>
  </div>
                  <button type="submit" class="btn">Registrati</button>
                  
</form>

<?php
                                if (isset($_GET['msg']) && $_GET['msg'] == "Username e Password non sono corretti!")
                                    echo "<div class='col-md-12'><b>" . $_GET['msg'] . "</b></div>";
                                ?>
                                <?php
                                if (isset($_GET['msg']) && $_GET['msg'] == "Username già in uso!")
                                    echo "<div class='col-md-12'><b>" . $_GET['msg'] . "</b></div>";
                                ?>
                                 
            </div>
      </div>
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
         <!--------js form----------->
         <script>
            var LoginForm=document.getElementById("LoginForm");
            var RegForm =document.getElementById("RegForm");
            var Indicator =document.getElementById("Indicator");

            function register(){
               RegForm.style.transform="translateX(0px)";
               LoginForm.style.transform="translateX(0px)";
               Indicator.style.transform="translateX(110px)";
            }
            function login(){
               RegForm.style.transform="translateX(300px)";
               LoginForm.style.transform="translateX(300px)";
               Indicator.style.transform="translateX(0px)";
            }

 </script>
<script>
const passwordField = document.getElementById("password-field");
const passwordToggle = document.getElementById("password-toggle");

passwordToggle.addEventListener("click", function() {
  const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
  passwordField.setAttribute("type", type);
  passwordToggle.querySelector("i").classList.toggle("fa-eye");
  passwordToggle.querySelector("i").classList.toggle("fa-eye-slash");
});
</script>
<script>
const passwordField2 = document.getElementById("password-field2");
const passwordToggle2 = document.getElementById("password-toggle2");

passwordToggle2.addEventListener("click", function() {
  const type2 = passwordField2.getAttribute("type") === "password" ? "text" : "password";
  passwordField2.setAttribute("type", type2);
  passwordToggle2.querySelector("i").classList.toggle("fa-eye");
  passwordToggle2.querySelector("i").classList.toggle("fa-eye-slash");
});
</script>







</body>
</html>
