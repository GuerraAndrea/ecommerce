<?php
include("connection.php");
session_start();
?>
<?php
$sql = "SELECT * FROM articoli WHERE Id = '" . $_GET["id"] . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                       
                                    }
                                   
                                    
                                    $sql = "SELECT * FROM recensioni JOIN utenti ON recensioni.IdUtente = utenti.Id WHERE IdArticolo = '" . $_GET["id"] . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                            <div>Utente:" . $row["Username"] . "<br>Data Recensione: <span>" . $row["DataComm"] . "</span></div>
                                            <div><p>Titolo: " . $row["Titolo"] . "</p><span>" . $row["Commento"] . "</span></div>";


                                                
                                            
                                            
                                        }
                                    }
                                    ?>