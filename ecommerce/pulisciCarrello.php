<?php
include("connection.php");
session_start();

$idCarrello;

//controllo se loggato
if (isset($_SESSION["IDCarrello"])) {
    $idCarrello = $_SESSION["IDCarrello"];
} else if (isset($_SESSION["IDCarrelloOspite"])) {
    $idCarrello = $_SESSION["IDCarrelloOspite"];
}

if (isset($idCarrello)) {
    //elimino tutte le righe nella tabella contains di quel cart
    $sql = $conn->prepare("DELETE contenuto FROM contenuto WHERE IdCarrello = ?");
    $sql->bind_param('i', $idCarrello);
    $sql->execute();
    header("location:carrello.php?msg=Clean successfully!&type=success");
} else
    header("location:carrello.php");
