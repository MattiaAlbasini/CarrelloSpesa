<?php
//Paramentri per la connessione al server MySQL
$host = "localhost";
$userDB = "root";
$pwdDB = "";

//Apro una connessione al server MySQL specificando i parametri
$conn = mysqli_connect($host,$userDB,$pwdDB);

//Controllo se la connessione al server MySQL è avvenuta con successo
if(!$conn)
    die('Errore nella connessione al server MySQL');
?>