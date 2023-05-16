<?php
include("connection.php");

session_start();

$idArticolo = $_GET['id'];
$idCarrello;

//controllo se loggato
if (isset($_SESSION["IDCarrello"])) {
    $idCarrello = $_SESSION["IDCarrello"];
} else if (isset($_SESSION["IDCarrelloOspite"])) {
    $idCarrello = $_SESSION["IDCarrelloOspite"];
}

if (isset($idCarrello) && isset($idArticolo)) {
    //rimuovo articolo
    $sql = $conn->prepare("DELETE FROM contenuto WHERE IdCarrello = ? AND IdArticolo = ?");
    $sql->bind_param('ii', $idCarrello, $idArticolo);
    $sql->execute();
    header("location:carrello.php?msg=Removed from cart successfully!&type=success");
} else
    header("location:carrello.php");