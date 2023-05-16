<?php
include("connection.php");

$id = $_GET["id"];

//cerco carrello associato all'ordine
$sql = $conn->prepare("DELETE FROM articoli WHERE Id = ?");
$sql->bind_param('i', $id);
$sql->execute();
header("location:myaccount.php?msg=Article deleted successfully!&type=success&pag=seller");
