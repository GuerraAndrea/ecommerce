<?php
include("connection.php");

session_start();

$idArticolo = $_GET['id'];
$idCarrello;
$q = $_GET['q'];

//controllo se loggato
if (isset($_SESSION["IDCarrello"])) {
    $idCarrello = $_SESSION["IDCarrello"];
} else if (isset($_SESSION["IDCarrelloOspite"])) {
    $idCarrello = $_SESSION["IDCarrelloOspite"];
}


if (isset($idCarrello) && isset($idArticolo) && isset($_GET['q'])) {
    //aggiorno quantità
    $sql = $conn->prepare("UPDATE contenuto SET Quantità= ? WHERE IdCarrello = ? AND IdArticolo = ?");
    $sql->bind_param('iii', $q, $idCarrello, $idArticolo);
    $sql->execute();
    header("location:carrello.php?msg=Updated successfully!&type=success");
} else {
    header("location:carrello.php");
}
