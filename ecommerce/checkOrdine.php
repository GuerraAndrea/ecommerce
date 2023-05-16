<?php
include("connection.php");
session_start();

//controllo quale indirizzo prendere
if (!isset($_POST["check"])) {
    $address = $_POST["address"];
} else {
    $address = $_POST["addressB"];
}

$date = new DateTime('now');
$date->add(new DateInterval('P7D'));
$date = $date->format("Y-m-d");

if (isset($_POST["radio"]))
    $paymentMethod = $_POST["radio"];

if (isset($_SESSION["IDCarrello"]))
    $idCarrello = $_SESSION["IDCarrello"];
else if (isset($_SESSION["IDCarrelloOspiti"]))
    $idCarrello = $_SESSION["IDCarrelloOspiti"];

$shippingCost = 5;


if (isset($paymentMethod)) {
    //trovo le quantità e gli id degli articoli acquistati
    $sql = $conn->prepare("SELECT IdArticolo, Titolo, Quantità, Pezzi FROM contenuto JOIN articoli ON IdArticolo = Id WHERE IdCarrello = ?");
    $sql->bind_param('i', $idCarrello);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        echo "droga";
        while ($row = $result->fetch_assoc()) {
            if ($row["Pezzi"] == 0) {
                header("location:carrello.php?msg=" . $row["Titolo"] . " not available!&type=danger");
                exit;
            }
            //aggiorno le quantità disponibili nel database
            $sql = $conn->prepare("UPDATE articoli SET Pezzi= ? WHERE Id = ?");
            $newPieces = $row["Pezzi"] - $row["Quantità"];
            $sql->bind_param('ii', $newPieces, $row["IdArticolo"]);
            $sql->execute();
        }
    } else {
        header("location:carrello.php");
        exit;
    }
    
    $sql = $conn->prepare("INSERT INTO ordini (DataConsegna, MetodoPagamento, IndirizzoConsegna, CostoSpedizione, IdCarrello) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param('sssii', $date, $paymentMethod, $address, $shippingCost, $idCarrello);
    $sql->execute();

    if (isset($_SESSION["IDCarrello"])) {
        //nuovo carrello per l'utente
        $sql = $conn->prepare("INSERT INTO carrello (IdUtente) VALUES (?)");
        $sql->bind_param('i', $_SESSION["ID"]);
        $sql->execute();

        //ultimo id inserito
        $idNewCart = $conn->insert_id;

        //salvo nuova sessione
        $_SESSION["IDCarrello"] = $idNewCart;
    } else if (isset($_SESSION["IDCarrelloOspite"])) {
        //creo nuovo carrello guest
        $sql = $conn->prepare("INSERT INTO carrello () VALUES ()");
        $sql->execute();

        //ultimo id inserito
        $idNewCart = $conn->insert_id;

        //salvo nuova sessione
        $_SESSION["IDCarrelloOspite"] = $idNewCart;

        //aggiorno cookie
        $cookie_name = "IDCarrelloOspite";
        $cookie_value = $idNewCart;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1  
    }
    header("location:carrello.php?msg=Ordered successfully!&type=success");
} else
    header("location:carrello.php?msg=Payment method must be set!&type=warning");
