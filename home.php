<?php

//Includo il file che esegue la creazione della connessione al server MySQL
require_once 'creaConn.php';
//Controllo che la selezione del database Prodotto sia avvenuta con successo
if(mysqli_select_db($conn, "prodotto")){
    //Disabilito le modifiche automatiche sul database
    mysqli_autocommit($conn,false);
    //Creo lo statement di selezione
    $stmt = mysqli_prepare($conn,"SELECT * FROM prodotto");
    //Eseguo lo statement e controllo che l'esecuzione sia avvenuta con successo
    if(mysqli_stmt_execute($stmt)){
        //Abilito le modifiche automatiche al database
        mysqli_autocommit($conn,true);
        //Memorizzo il risultato dello statement
        $result = mysqli_stmt_get_result($stmt);
        //Controllo che lo statement abbia restituito almeno un risultato
        if(mysqli_num_rows($result) > 0){
            //Creo una tabella in HTML per visualizzare i campi
            echo "<h1>Tabella Prodotto</h1><table border='1'><tr><th>IdProdotto</th><th>Nome Prodotto</th><th>Prezzo</th></tr>";
            //Estraggo i campi di prodotto e li aggiungo nella tabella HTML
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row["idProdotto"]."</td><td>".$row["nomeProdotto"].$row["prezzo"] ."</td></tr>";
            }
            echo "</table>";
            //Libero la memoria dal risultato dello statement
            mysqli_stmt_free_result($stmt);
            //Chiudo lo statement
            mysqli_stmt_close($stmt);
        }else{
            echo "L'interrogazione non ha restituito risultati";
        }
    }else{
        //Se l'esecuzione dello statement fallisce lo notifico e mostro l'errore MySQL
        echo '<br>Esecuzione SQL fallita! ' . mysqli_error($conn);
        //Effettuo il rollback delle modifiche effettuate sul database
        mysqli_rollback($conn);
    }
}else{
    echo 'Problemi nella selezione del database';
}
//Chiudo la connessione al server MySQL
mysqli_close($conn);
?>

?>