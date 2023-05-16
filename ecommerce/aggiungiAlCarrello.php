<?php
include("connection.php");

session_start();

$idArticolo = $_GET['id'];
$idCarrello;

//prendo idCart
if (isset($_SESSION["IDCarrello"])) {                       //se loggato
    $idCarrello = $_SESSION["IDCarrello"];
} else if (isset($_SESSION["IDCarrelloOspite"])) {           //se c'è il carrello guest con il cookie
    $idCarrello = $_SESSION["IDCarrelloOspite"];
} else if (!isset($_SESSION["IDCarrelloOspite"])) {          //se non c'è il carrello guest con il cookie e non è loggato
    //creo carrello guest
    $sql = $conn->prepare("INSERT INTO carrello () VALUES ()");
    $sql->execute();

    //ultimo id inserito
    $idCarrello = $conn->insert_id;

    //salvo il carrello anche nella sessione
    $_SESSION["IDCarrelloOspite"] = $idCarrello;

    //creo cookie con valore idCart
    $cookie_name = "IDCarrelloOspite";
    $cookie_value = $idCarrello;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}

//controllo se campi validi
if (isset($idCarrello) && isset($idArticolo) && $_GET["q"] != null && $_GET["q"] != 0) {
    //controllo se gia presente articolo in quel carrello
    $sql = $conn->prepare("SELECT Quantità FROM contenuto WHERE IdCarrello = ? AND IdArticolo = ?");
    $sql->bind_param('ii', $idCarrello, $idArticolo);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows > 0) {
        //se già presente aggiorno la quantità
        $row = $result->fetch_assoc();
        $nuovaQuantità = $row["Quantità"] + $_GET["q"];

        //controllo disponibilità articolo
        $sql = $conn->prepare("SELECT Pezzi,Id FROM articoli WHERE Id = ?");
        $sql->bind_param('i', $idArticolo);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row["Pezzi"] >= $newQuantity) {
                //aggiorno quantità articolo
                $sql = $conn->prepare("UPDATE contenuto SET Quantità = ? WHERE IdCarrello = ? AND IdArticolo = ?");
                $sql->bind_param("iii", $nuovaQuantità, $idCarrello, $idArticolo);
                $sql->execute();
                header("location:dettagliProdotto.php?id=". $row["Id"] ."&q=1&msg=Added to cart successfully!&type=success");
            } else {
                header("location:dettagliProdotto.php?id=". $row["Id"] ."&q=1&msg=Insufficient available pieces of the article!&type=danger");
            }
        } else
            header("location:dettagliProdotto.php?id=". $row["Id"] ."&q=1&msg=Article doesn't exist!&type=danger");
    } else {
        //controllo disponibilità articolo
        $sql = $conn->prepare("SELECT Pezzi,Id FROM articoli WHERE Id = ?");
        $sql->bind_param('i', $idArticolo);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row["Pezzi"] >= $_GET["q"]) {
                //aggiungo articolo
                $sql = $conn->prepare("INSERT INTO contenuto (IdCarrello, IdArticolo, Quantità) VALUES (?,?,?)");
                $sql->bind_param('iii', $idCarrello, $idArticolo, $_GET['q']);
                $sql->execute();
                header("location:dettagliProdotto.php?id=". $row["Id"] ."&q=1&msg=Added to cart successfully!&type=success");
            } else {
                header("location:dettagliProdotto.php?id=". $row["Id"] ."&q=1&msg=Insufficient available pieces of the article!&type=danger");
            }
        } else
            header("location:dettagliProdotto.php?id=". $row["Id"] ."&q=1&msg=Article doesn't exist!&type=danger");
    }
} else
    header("location:dettagliProdotto.php?id=". $row["Id"] ."&q=1&msg=Article not available!&type=danger");
