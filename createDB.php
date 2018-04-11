<?php
//Includo il file che esegue la creazione della connessione al server MySQL
require_once 'creaConn.php';
//Disabilito le modifiche automatiche sul database
mysqli_autocommit($conn,false);
//Creo lo statement per la creazione del database Prodotto
$stmt = mysqli_prepare($conn, "CREATE DATABASE IF NOT EXISTS prodotto");
//Eseguo lo statement e controllo che l'esecuzione sia avvenuta con successo
if(mysqli_stmt_execute($stmt)){
    //Abilito le modifiche automatiche sul database
    mysqli_autocommit($conn,true);
    //Libero la memoria dal risultato dello statement
    mysqli_stmt_free_result($stmt);
    //Chiudo lo statement
    mysqli_stmt_close($stmt);
    echo '<h1>Creazione database</h1>Connessione al server eseguita!<br>Database Dipendente creato correttamente!';
}else{
    //Se l'esecuzione dello statement fallisce lo notifico e mostro l'errore MySQL
    echo '<br>Errore nella creazione del database! ' . mysqli_error($conn);
    //Effettuo il rollback delle modifiche effettuate sul database
    mysqli_rollback($conn);
}

//Controllo che la selezione del database Prodotto sia avvenuta con successo
if(mysqli_select_db($conn, "prodotto")){
    //Disabilito le modifiche automatiche sul database
    mysqli_autocommit($conn,false);
    //Creo lo statement per la creazione della tabella prodotto
    $stmt = mysqli_prepare($conn, "CREATE TABLE IF NOT EXISTS prodotto(
        idProdotto INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nomeProdotto VARCHAR(60),
        prezzo FLOAT
        );");
    //Eseguo lo statement e controllo che l'esecuzione sia avvenuta con successo
    if(mysqli_stmt_execute($stmt)){
        ////Abilito le modifiche automatiche al database
        mysqli_autocommit($conn,true);
        //Libero la memoria dal risultato dello statement
        mysqli_stmt_free_result($stmt);
        //Chiudo lo statement
        mysqli_stmt_close($stmt);
        echo '<br><br>Tabella Prodotto creata correttamente!';
    }else{
        //Se l'esecuzione dello statement fallisce lo notifico e mostro l'errore MySQL
        echo '<br>Errore nella creazione della tabella Prodotto! ' . mysqli_error($conn);
        //Effettuo il rollback delle modifiche effettuate sul database
        mysqli_rollback($conn);
    }

    //Popolamento del database Prodotto
    $stmt = mysqli_prepare($conn, "INSERT INTO prodotto(titoloProdotto, prezzo) VALUES ('Dizionario di inglese', 50.00);
    INSERT INTO prodotto(titoloProdotto, prezzo) VALUES ('Libro di informatica', 39.95);
    INSERT INTO prodotto(titoloProdotto, prezzo) VALUES ('Libro di matematica', 15.00);
    INSERT INTO prodotto(titoloProdotto, prezzo) VALUES ('Libro di storia', 25.20);");
    //Eseguo lo statement e controllo che l'esecuzione sia avvenuta con successo
    if(mysqli_stmt_execute($stmt)){
        ////Abilito le modifiche automatiche al database
        mysqli_autocommit($conn,true);
        //Libero la memoria dal risultato dello statement
        mysqli_stmt_free_result($stmt);
        //Chiudo lo statement
        mysqli_stmt_close($stmt);
        echo '<br><br>Tabella Prodotto creata correttamente!';
    }else{
        //Se l'esecuzione dello statement fallisce lo notifico e mostro l'errore MySQL
        echo '<br>Errore nel popolamento della tabella Prodotto! ' . mysqli_error($conn);
        //Effettuo il rollback delle modifiche effettuate sul database
        mysqli_rollback($conn);
    }
}else{
    echo 'Problemi di selezione del database!';
}
//Chiudo la connessione al server MySQL
mysqli_close($conn);
?>