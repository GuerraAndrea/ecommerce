<?php

include("connection.php");

// Variabili inserite
$titolo = $_POST["titolo"];
$descrizione = $_POST["descrizione"];
$venditore = $_POST["venditore"];
$condizione = $_POST["condizione"];
$prezzo = $_POST["prezzo"];
$sconto = $_POST["sconto"];
$pezzi = $_POST["pezzi"];
$categoria = $_POST["categoria"];
// Seleziono tutti i titoli presenti nel database per controllare se già presenti
$sql = "SELECT Titolo FROM articoli";
$result = $conn->query($sql);
$trovato = false;

// Controllo
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($titolo == $row["Titolo"]) {
            header("location:aggiungiArticolo.php?msg=Articolo già presente!");
            $trovato = true;
            return 0;
        }
    }
}

// Nuovo articolo
if ($trovato == false) {
    $sql = "INSERT INTO articoli (Titolo, Descrizione, Venditore, Condizione, Prezzo, Sconto, Pezzi, IdCategoria)
            VALUES ('$titolo', '$descrizione', '$venditore', '$condizione', '$prezzo', '$sconto', '$pezzi', '$categoria')";
    if ($conn->query($sql) === TRUE) {
        // Recupera l'ID del prodotto appena inserito
        $lastInsertId = $conn->insert_id;

        // Carica l'immagine
        if (isset($_FILES['userfile']['name'])) {
            $uploaddir = 'img/';
            $uploadfile = $uploaddir . 'prodotto-' . $lastInsertId . '.jpg';
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

header("location: aggiungiArticolo.php");
$conn->close();