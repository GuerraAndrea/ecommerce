<?php
include("connection.php");
session_start();

$idArticolo = $_GET["id"];
$titolo = $_GET["titolo"];


    if (isset($_SESSION["ID"])) {
        $sql = $conn->prepare("INSERT INTO recensioni (IdArticolo, IdUtente, Titolo, Commento) VALUES (?, ?, ?, ?)");
        $sql->bind_param('iiss', $idArticolo, $_SESSION["ID"], $titolo, $_GET["text"]);
        $sql->execute();
        header("location: dettagliProdotto.php?id=$idArticolo&q=1&&msg=Review added successfully!&type=success");
    } else
        header("location: dettagliProdotto.php?msg=Must be logged in to post a review!&type=warning");

  
